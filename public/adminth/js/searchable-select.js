(function () {
    function getSelectedLabel(select) {
        var option = select.options[select.selectedIndex];
        return option ? option.text.trim() : '';
    }

    function initSearchableSelect(select) {
        if (select.dataset.searchableInit === '1') {
            return;
        }
        select.dataset.searchableInit = '1';

        var wrapper = document.createElement('div');
        wrapper.className = 'searchable-select';
        select.parentNode.insertBefore(wrapper, select);
        wrapper.appendChild(select);

        select.classList.add('searchable-select-native');
        select.tabIndex = -1;
        select.setAttribute('aria-hidden', 'true');

        var display = document.createElement('input');
        display.type = 'text';
        display.className = 'form-control searchable-select-display';
        display.autocomplete = 'off';
        display.placeholder = select.dataset.searchPlaceholder || 'Search...';
        display.setAttribute('role', 'combobox');
        display.setAttribute('aria-expanded', 'false');
        display.setAttribute('aria-autocomplete', 'list');
        wrapper.insertBefore(display, select);

        var menu = document.createElement('div');
        menu.className = 'searchable-select-menu list-group shadow-sm';
        menu.setAttribute('role', 'listbox');
        wrapper.appendChild(menu);

        var options = Array.from(select.options).map(function (option) {
            return {
                value: option.value,
                label: option.text.trim(),
            };
        });

        var isOpen = false;
        var activeIndex = -1;

        function closeMenu() {
            isOpen = false;
            activeIndex = -1;
            menu.style.display = 'none';
            wrapper.classList.remove('searchable-select-open');
            display.setAttribute('aria-expanded', 'false');
            display.value = getSelectedLabel(select);
        }

        function highlightActive() {
            var items = menu.querySelectorAll('[data-searchable-option]');
            items.forEach(function (item, index) {
                item.classList.toggle('active', index === activeIndex);
            });

            if (activeIndex >= 0 && items[activeIndex]) {
                items[activeIndex].scrollIntoView({ block: 'nearest' });
            }
        }

        function chooseOption(value) {
            select.value = value;
            select.dispatchEvent(new Event('change', { bubbles: true }));
            closeMenu();
        }

        function renderMenu(filterText) {
            menu.innerHTML = '';
            activeIndex = -1;

            var term = (filterText || '').trim().toLowerCase();
            var filtered = options.filter(function (option) {
                return !term || option.label.toLowerCase().indexOf(term) !== -1;
            });

            if (!filtered.length) {
                var emptyItem = document.createElement('div');
                emptyItem.className = 'list-group-item text-muted small';
                emptyItem.textContent = 'No matches found';
                menu.appendChild(emptyItem);
                return;
            }

            filtered.forEach(function (option, index) {
                var item = document.createElement('button');
                item.type = 'button';
                item.className = 'list-group-item list-group-item-action py-2';
                item.textContent = option.label;
                item.dataset.searchableOption = '1';
                item.dataset.value = option.value;

                if (select.value === option.value) {
                    item.classList.add('active');
                    activeIndex = index;
                }

                item.addEventListener('mousedown', function (event) {
                    event.preventDefault();
                    chooseOption(option.value);
                });

                menu.appendChild(item);
            });
        }

        function openMenu() {
            isOpen = true;
            wrapper.classList.add('searchable-select-open');
            display.setAttribute('aria-expanded', 'true');
            renderMenu(display.value === getSelectedLabel(select) ? '' : display.value);
            menu.style.display = 'block';
        }

        display.addEventListener('focus', function () {
            display.value = '';
            openMenu();
        });

        display.addEventListener('input', function () {
            if (!isOpen) {
                openMenu();
            }
            renderMenu(display.value);
        });

        display.addEventListener('keydown', function (event) {
            var items = menu.querySelectorAll('[data-searchable-option]');

            if (event.key === 'ArrowDown') {
                event.preventDefault();
                if (!isOpen) {
                    openMenu();
                    items = menu.querySelectorAll('[data-searchable-option]');
                }
                activeIndex = Math.min(activeIndex + 1, items.length - 1);
                highlightActive();
            } else if (event.key === 'ArrowUp') {
                event.preventDefault();
                activeIndex = Math.max(activeIndex - 1, 0);
                highlightActive();
            } else if (event.key === 'Enter') {
                event.preventDefault();
                if (activeIndex >= 0 && items[activeIndex]) {
                    chooseOption(items[activeIndex].dataset.value);
                }
            } else if (event.key === 'Escape') {
                closeMenu();
                display.blur();
            }
        });

        document.addEventListener('click', function (event) {
            if (!wrapper.contains(event.target)) {
                closeMenu();
            }
        });

        select.addEventListener('change', function () {
            display.value = getSelectedLabel(select);
        });

        display.value = getSelectedLabel(select);
    }

    function initAll() {
        document.querySelectorAll('select[data-searchable]').forEach(initSearchableSelect);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAll);
    } else {
        initAll();
    }

    window.initSearchableSelects = initAll;
})();
