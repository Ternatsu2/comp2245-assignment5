document.addEventListener("DOMContentLoaded", () => {
    const lookupButton = document.getElementById("lookup");
    const lookupCitiesButton = document.getElementById("lookup-cities");
   
    lookupButton.addEventListener("click", () => {
        const countryName = document.getElementById("country").value;
        lookupCountryOrCities(countryName, "country");
    });
   
    lookupCitiesButton.addEventListener("click", () => {
        const countryName = document.getElementById("country").value;
        lookupCountryOrCities(countryName, "cities");
    });
   
    function lookupCountryOrCities(country, type) {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("result").innerHTML = xhr.responseText;
            }
        };
        xhr.open("GET", `world.php?country=${encodeURIComponent(country)}&lookup=${type}`, true);
        xhr.send();
    }
   });
   