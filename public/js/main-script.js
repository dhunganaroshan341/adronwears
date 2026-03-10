        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.submenu.dropdown').forEach(function(item) {
                item.addEventListener('mouseenter', function() {
                    const dropdown = this.querySelector('.dropdown-menu');
                    if (dropdown) {
                        dropdown.classList.remove('dropdown-menu-end');

                        const rect = dropdown.getBoundingClientRect();
                        if (rect.right > window.innerWidth) {
                            dropdown.classList.add('dropdown-menu-end');
                        }
                    }
                });
            });
        });


    {/* -- flipping child and grand chiold dropdown script -- */}

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.dropdown-menu').forEach(function(dropdown) {
                const parentItem = dropdown.parentElement;

                parentItem.addEventListener('mouseenter', function() {
                    // Reset previous state
                    dropdown.classList.remove('dropdown-menu-left');
                    parentItem.classList.remove('flipped');

                    // Remove flipped class from child link if previously added
                    const childLink = parentItem.querySelector('.child-dropdown-a');
                    if (childLink) {
                        childLink.classList.remove('child-a-reversed');
                    }

                    // Check position
                    const rect = dropdown.getBoundingClientRect();
                    if (rect.right > window.innerWidth) {
                        dropdown.classList.add('dropdown-menu-left');
                        parentItem.classList.add('flipped');

                        // Flip only this child link
                        if (childLink) {
                            childLink.classList.add('child-a-reversed');
                        }
                    }
                });
            });
        });

