document.addEventListener("DOMContentLoaded", () => {
    const lookupButton = document.getElementById("lookup");

    lookupButton.addEventListener("click", () => {
        const countryName = document.getElementById("country").value;

        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("result").innerHTML = xhr.responseText;
            }
        };

        xhr.open("GET", `world.php?country=${encodeURIComponent(countryName)}`, true);
        xhr.send();
    });
});
