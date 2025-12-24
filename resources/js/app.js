// resources/js/app.js

import './bootstrap';

// ============================================
// GLOBAL UTILITIES
// ============================================

// Toast Notification
window.showToast = function(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `fixed top-4 right-4 px-6 py-4 rounded-lg shadow-lg z-50 transform transition-all duration-300 translate-x-full ${
        type === 'success' ? 'bg-green-500' :
        type === 'error' ? 'bg-red-500' :
        type === 'warning' ? 'bg-yellow-500' : 'bg-blue-500'
    } text-white`;
    toast.textContent = message;

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.classList.remove('translate-x-full');
    }, 100);

    setTimeout(() => {
        toast.classList.add('translate-x-full');
        setTimeout(() => toast.remove(), 300);
    }, 3000);
};

// Confirm Dialog
window.confirmDelete = function(message = 'Apakah Anda yakin ingin menghapus data ini?') {
    return confirm(message);
};

// Format Number
window.formatNumber = function(num, decimals = 2) {
    return Number(num).toFixed(decimals);
};

// ============================================
// ASSESSMENT FORM UTILITIES
// ============================================

class AssessmentForm {
    constructor() {
        this.checkboxes = document.querySelectorAll('.observation-check');
        this.itemCounts = {};
        this.init();
    }

    init() {
        if (this.checkboxes.length === 0) return;

        this.setupEventListeners();
        this.setupAutoSave();
        this.updateAllCounts();
    }

    setupEventListeners() {
        this.checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', (e) => {
                this.handleCheckboxChange(e.target);
                this.saveToLocalStorage();
            });
        });

        // Check all / Uncheck all buttons
        this.setupBulkActions();
    }

    handleCheckboxChange(checkbox) {
        const itemId = checkbox.dataset.item;
        const frequency = parseInt(checkbox.dataset.frequency);

        // Update count
        this.updateItemCount(itemId, frequency);

        // Visual feedback
        this.highlightRow(checkbox);
    }

    updateItemCount(itemId, frequency) {
        const checkedCount = document.querySelectorAll(`input[data-item="${itemId}"]:checked`).length;
        const percentage = (checkedCount / frequency * 100).toFixed(2);

        this.itemCounts[itemId] = {
            checked: checkedCount,
            frequency: frequency,
            percentage: percentage
        };

        // Update display if score column exists
        const scoreCell = document.querySelector(`[data-score-for="${itemId}"]`);
        if (scoreCell) {
            scoreCell.textContent = percentage + '%';
            scoreCell.className = this.getScoreClass(percentage);
        }
    }

    updateAllCounts() {
        const items = new Set();
        this.checkboxes.forEach(cb => items.add(cb.dataset.item));

        items.forEach(itemId => {
            const checkbox = document.querySelector(`input[data-item="${itemId}"]`);
            if (checkbox) {
                const frequency = parseInt(checkbox.dataset.frequency);
                this.updateItemCount(itemId, frequency);
            }
        });
    }

    getScoreClass(percentage) {
        if (percentage >= 80) return 'text-green-600 font-bold';
        if (percentage >= 60) return 'text-blue-600 font-semibold';
        if (percentage >= 40) return 'text-yellow-600 font-medium';
        return 'text-red-600 font-medium';
    }

    highlightRow(checkbox) {
        const row = checkbox.closest('tr');
        row.classList.add('bg-blue-50');
        setTimeout(() => row.classList.remove('bg-blue-50'), 500);
    }

    setupBulkActions() {
        // Add "Select All Week" buttons
        document.querySelectorAll('[data-select-week]').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const week = e.target.dataset.selectWeek;
                const itemId = e.target.dataset.item;
                this.selectWeek(itemId, week);
            });
        });

        // Add "Copy Previous Week" functionality
        document.querySelectorAll('[data-copy-week]').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const itemId = e.target.dataset.item;
                this.copyPreviousWeek(itemId);
            });
        });
    }

    selectWeek(itemId, week) {
        const weekRanges = {
            '1': [1, 7],
            '2': [8, 14],
            '3': [15, 21],
            '4': [22, 28],
            '5': [29, 31]
        };

        const [start, end] = weekRanges[week];

        for (let day = start; day <= end; day++) {
            const checkbox = document.querySelector(`input[name="observations[${itemId}][${day}]"]`);
            if (checkbox) {
                checkbox.checked = true;
                this.handleCheckboxChange(checkbox);
            }
        }
    }

    copyPreviousWeek(itemId) {
        const lastWeekPattern = [];
        for (let day = 24; day <= 30; day++) {
            const checkbox = document.querySelector(`input[name="observations[${itemId}][${day}]"]`);
            if (checkbox) {
                lastWeekPattern.push(checkbox.checked);
            }
        }

        // Apply to current week (if applicable)
        lastWeekPattern.forEach((checked, index) => {
            const day = index + 24;
            const checkbox = document.querySelector(`input[name="observations[${itemId}][${day}]"]`);
            if (checkbox) {
                checkbox.checked = checked;
                this.handleCheckboxChange(checkbox);
            }
        });

        showToast('Pattern minggu sebelumnya berhasil disalin', 'success');
    }

    // Auto-save to localStorage
    setupAutoSave() {
        this.loadFromLocalStorage();

        // Save every 30 seconds
        setInterval(() => this.saveToLocalStorage(), 30000);

        // Save before unload
        window.addEventListener('beforeunload', () => this.saveToLocalStorage());
    }

    saveToLocalStorage() {
        const formData = {};
        this.checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const name = checkbox.name;
                formData[name] = true;
            }
        });

        const key = this.getStorageKey();
        localStorage.setItem(key, JSON.stringify(formData));

        // Show auto-save indicator
        this.showAutoSaveIndicator();
    }

    loadFromLocalStorage() {
        const key = this.getStorageKey();
        const saved = localStorage.getItem(key);

        if (saved) {
            const formData = JSON.parse(saved);
            Object.keys(formData).forEach(name => {
                const checkbox = document.querySelector(`input[name="${name}"]`);
                if (checkbox) {
                    checkbox.checked = true;
                }
            });
            this.updateAllCounts();
            showToast('Data berhasil dimuat dari auto-save', 'info');
        }
    }

    getStorageKey() {
        const url = window.location.pathname;
        return `assessment_form_${url}`;
    }

    showAutoSaveIndicator() {
        const indicator = document.getElementById('auto-save-indicator');
        if (indicator) {
            indicator.classList.remove('opacity-0');
            setTimeout(() => indicator.classList.add('opacity-0'), 2000);
        }
    }

    clearLocalStorage() {
        const key = this.getStorageKey();
        localStorage.removeItem(key);
    }
}

// ============================================
// SEARCH & FILTER
// ============================================

class SearchFilter {
    constructor(inputSelector, tableSelector) {
        this.input = document.querySelector(inputSelector);
        this.table = document.querySelector(tableSelector);

        if (this.input && this.table) {
            this.init();
        }
    }

    init() {
        this.input.addEventListener('input', (e) => {
            this.filterTable(e.target.value.toLowerCase());
        });
    }

    filterTable(searchTerm) {
        const rows = this.table.querySelectorAll('tbody tr');
        let visibleCount = 0;

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Show "no results" message
        this.toggleNoResults(visibleCount === 0);
    }

    toggleNoResults(show) {
        let noResultsRow = this.table.querySelector('.no-results-row');

        if (show && !noResultsRow) {
            const colCount = this.table.querySelector('thead tr').children.length;
            noResultsRow = document.createElement('tr');
            noResultsRow.className = 'no-results-row';
            noResultsRow.innerHTML = `<td colspan="${colCount}" class="px-6 py-4 text-center text-gray-500">Tidak ada data yang cocok</td>`;
            this.table.querySelector('tbody').appendChild(noResultsRow);
        } else if (!show && noResultsRow) {
            noResultsRow.remove();
        }
    }
}

// ============================================
// CHART UTILITIES
// ============================================

class ChartManager {
    constructor() {
        this.charts = {};
    }

    createBarChart(canvasId, data) {
        const ctx = document.getElementById(canvasId);
        if (!ctx) return;

        // Simple bar chart using canvas
        // For production, use Chart.js library
        this.charts[canvasId] = {
            type: 'bar',
            data: data
        };
    }

    createLineChart(canvasId, data) {
        const ctx = document.getElementById(canvasId);
        if (!ctx) return;

        this.charts[canvasId] = {
            type: 'line',
            data: data
        };
    }
}

// ============================================
// FORM VALIDATION
// ============================================

class FormValidator {
    constructor(formSelector) {
        this.form = document.querySelector(formSelector);
        if (this.form) {
            this.init();
        }
    }

    init() {
        this.form.addEventListener('submit', (e) => {
            if (!this.validate()) {
                e.preventDefault();
                showToast('Mohon periksa kembali form Anda', 'error');
            }
        });

        // Real-time validation
        this.form.querySelectorAll('input, select, textarea').forEach(field => {
            field.addEventListener('blur', () => this.validateField(field));
        });
    }

    validate() {
        let isValid = true;
        const fields = this.form.querySelectorAll('[required]');

        fields.forEach(field => {
            if (!this.validateField(field)) {
                isValid = false;
            }
        });

        return isValid;
    }

    validateField(field) {
        const value = field.value.trim();
        let isValid = true;
        let message = '';

        // Required check
        if (field.hasAttribute('required') && !value) {
            isValid = false;
            message = 'Field ini wajib diisi';
        }

        // Email check
        if (field.type === 'email' && value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                isValid = false;
                message = 'Format email tidak valid';
            }
        }

        // Number check
        if (field.type === 'number' && value) {
            const min = field.getAttribute('min');
            const max = field.getAttribute('max');
            const num = parseFloat(value);

            if (min && num < parseFloat(min)) {
                isValid = false;
                message = `Nilai minimal ${min}`;
            }
            if (max && num > parseFloat(max)) {
                isValid = false;
                message = `Nilai maksimal ${max}`;
            }
        }

        // Show/hide error
        this.toggleError(field, !isValid, message);

        return isValid;
    }

    toggleError(field, show, message) {
        let errorDiv = field.parentElement.querySelector('.error-message');

        if (show) {
            if (!errorDiv) {
                errorDiv = document.createElement('div');
                errorDiv.className = 'error-message text-red-500 text-sm mt-1';
                field.parentElement.appendChild(errorDiv);
            }
            errorDiv.textContent = message;
            field.classList.add('border-red-500');
        } else {
            if (errorDiv) errorDiv.remove();
            field.classList.remove('border-red-500');
        }
    }
}

// ============================================
// PRINT UTILITIES
// ============================================

window.printReport = function(elementId) {
    const element = document.getElementById(elementId);
    if (!element) return;

    const printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write('<html><head><title>Print</title>');
    printWindow.document.write('<style>');
    printWindow.document.write(`
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f3f4f6; }
        @media print {
            .no-print { display: none; }
        }
    `);
    printWindow.document.write('</style></head><body>');
    printWindow.document.write(element.innerHTML);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
};

// ============================================
// INITIALIZE ON DOM READY
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    // Initialize Assessment Form
    if (document.querySelector('.observation-check')) {
        window.assessmentForm = new AssessmentForm();
    }

    // Initialize Search/Filter
    new SearchFilter('#search-input', '#data-table');

    // Initialize Form Validation
    new FormValidator('#main-form');

    // Initialize Chart Manager
    window.chartManager = new ChartManager();

    // Auto-hide flash messages
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);

    // Confirm before delete
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (!confirmDelete()) {
                e.preventDefault();
            }
        });
    });

    // Smooth scroll to errors
    const firstError = document.querySelector('.error-message');
    if (firstError) {
        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});

// Export for use in blade templates
export { AssessmentForm, SearchFilter, ChartManager, FormValidator };
