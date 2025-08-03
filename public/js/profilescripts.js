import { countries } from '././country-codes.js';

document.addEventListener('DOMContentLoaded', () => {
    const selectElement = document.getElementById('countryCode');
    if (!selectElement) return;

    // 1. Define and find your default country
    const defaultCountryCode = 'MX'; // Use the unique code for Mexico
    let defaultCountry = null;

    // Create a new array *without* the default country
    const otherCountries = countries.filter(country => {
        if (country.code === defaultCountryCode) {
            defaultCountry = country; // Save the default country object
            return false; // Exclude it from the 'otherCountries' array
        }
        return true; // Keep all other countries
    });

    // Optional: Sort the rest of the countries alphabetically
    otherCountries.sort((a, b) => a.name.localeCompare(b.name));

    // 2. Populate the dropdown with the other countries
    otherCountries.forEach(country => {
        const option = document.createElement('option');
        option.value = country.dial_code;
        option.textContent = `${country.name} (${country.dial_code})`;
        selectElement.appendChild(option);
    });

    // 3. Append the default country at the end and set the value
    if (defaultCountry) {
        const option = document.createElement('option');
        option.value = defaultCountry.dial_code;
        option.textContent = `${defaultCountry.name} (${defaultCountry.dial_code})`;
        selectElement.appendChild(option); // Appears last in the list

        // Set the <select> element's value to make this the default
        selectElement.value = defaultCountry.dial_code;
    }
});