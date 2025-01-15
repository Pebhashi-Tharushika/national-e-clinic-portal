document.querySelectorAll('svg path').forEach(path => {
    path.addEventListener('click', () => {
        let pathSegment = "";
        let province = path.getAttribute('title');  

        switch (province) {
            case 'Eastern Province':
                pathSegment = "eastern";
                break;
            case 'Northern Province':  
                pathSegment = "northern";
                break;
            case 'North Western Province':
                pathSegment = "north-western";  
                break;
            case 'Western Province':
                pathSegment = "western";
                break;
            case 'Southern Province':
                pathSegment = "southern";
                break;
            case 'Sabaragamuwa Province':
                pathSegment = "sabaragamuwa";
                break;
            case 'Uva Province':  
                pathSegment = "uva";
                break;
            case 'Central Province':
                pathSegment = "central";
                break;
            case 'North Central Province':
                pathSegment = "north-central";
                break;
            default:
                pathSegment = "home";  
        }

        // Redirect to the PHP file
        window.location.href = "/national-e-clinic-portal/provinces/" + pathSegment + "-province.php";
    });
});
