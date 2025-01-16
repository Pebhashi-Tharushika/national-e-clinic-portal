const provinceMap = {
    'Eastern Province': 'eastern',
    'Northern Province': 'northern',
    'North Western Province': 'north-western',
    'Western Province': 'western',
    'Southern Province': 'southern',
    'Sabaragamuwa Province': 'sabaragamuwa',
    'Uva Province': 'uva',
    'Central Province': 'central',
    'North Central Province': 'north-central'
};

document.querySelectorAll('svg path').forEach(path => {
    path.addEventListener('click', () => {
        const province = path.getAttribute('title');
        const valueOfQueryString = provinceMap[province];

        window.location.href = "/national-e-clinic-portal/province.php?province=" + encodeURIComponent(valueOfQueryString);
    });
});
