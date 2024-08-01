document.addEventListener('DOMContentLoaded', function () {
    const filterButtons = document.querySelectorAll('.filter-button');
    const searchInput = document.getElementById('searchInput');
    const slides = document.querySelectorAll('.slide');

    // Initial filter state
    let currentFilter = 'all'; // Default filter value

    // Add click event listeners to filter buttons
    filterButtons.forEach(button => {
        button.addEventListener('click', function () {
            const filterValue = button.getAttribute('data-filter');
            filterClubsChapters(filterValue);
            currentFilter = filterValue;
        });
    });

    // Add input event listener to search input
    searchInput.addEventListener('input', function () {
        const searchTerm = searchInput.value.trim().toLowerCase();
        filterClubsChapters(currentFilter, searchTerm);
    });

    function filterClubsChapters(filter, searchTerm = '') {
        slides.forEach(slide => {
            const clubChapters = slide.querySelectorAll('.club-chapter');

            clubChapters.forEach(clubChapter => {
                const type = clubChapter.getAttribute('data-type').toLowerCase();
                const title = clubChapter.querySelector('h3').textContent.toLowerCase();
                const description = clubChapter.querySelector('p:first-of-type').textContent.toLowerCase();

                const matchesFilter = filter === 'all' || type === filter || (filter === 'technical' &&  type === 'technical-chapters');
                const matchesSearch = title.includes(searchTerm) || description.includes(searchTerm);

                if (matchesFilter && matchesSearch) {
                    clubChapter.style.display = 'block';
                } else {
                    clubChapter.style.display = 'none';
                }
            });
        });
    }
});
