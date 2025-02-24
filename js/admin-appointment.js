document.addEventListener('DOMContentLoaded', () => {
    const btnReset = document.getElementById('reset');
    const btnSearch = document.getElementById('search');
    const searchContent = document.getElementById('patient-appointment-content2');
    const checkboxes = document.querySelectorAll('#filter-options input[type="checkbox"]');
    const selections = document.querySelectorAll('#filter-select select');
    
    let selectedFilters = [];

    document.querySelectorAll('.province').forEach(element => {
        element.addEventListener('click', event => {

            let provinceName = event.target.textContent.trim() // Get inner text of the clicked div

            document.querySelectorAll('.province').forEach(p => p.classList.remove('active'));
            element.classList.add('active');

            document.querySelector('#patient-appointment-content2 > h4').innerText = provinceName + " Appointments";

            resetFilters();
            searchContent.style.display='none';
            searchContent.style.display='flex';

        });
    });


    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener("change", () => {
            selectedFilters = Array.from(checkboxes)
                .filter(cb => cb.checked) // Get only checked checkboxes
                .map(cb => cb.value); // Get their values

            console.log("Selected Options:", selectedFilters);

            disableButton(selectedFilters.length === 0);
        });
    });

    selections.forEach(element => {
        element.addEventListener('change', event => {
            console.log(event.target.value);
        });
    });

   btnReset.addEventListener('click', () => resetFilters());

    function resetFilters(){
        // unchecked all filters
        checkboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
        selectedFilters = [];
        console.log(selectedFilters.length);

        displaySelector('all','none'); // disappear all selector

        disableButton(true);
    }

    function disableButton(isDisable){
        const btns = document.querySelectorAll('#button-wrapper>button').forEach(btn => btn.disabled = isDisable);
    }

    function displaySelector(selector, show){
        let allselectors = document.querySelectorAll('#filter-select .col');
        allselectors.forEach(s => {
            if(selector.toLowerCase() === 'all'){
                s.style.display = show;
            }else if(selector.toLowerCase() === 'hospital'){
                document.getElementById('hospital').style.display= show;
            }else if(selector.toLowerCase() === 'clinic'){
                document.getElementById('clinic').style.display= show;
            }else if(selector.toLowerCase() === 'patient'){
                document.getElementById('patient').style.display= show;
            }else if(selector.toLowerCase() === 'user'){
                document.getElementById('user').style.display= show;
            }else if(selector.toLowerCase() === 'appointment date'){
                document.getElementById('appointment-date').style.display= show;
            }else if(selector.toLowerCase() === 'reserved date'){
                document.getElementById('reserved-date').style.display= show;
            }
            
        });
    }
    
});