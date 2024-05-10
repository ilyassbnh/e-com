document.addEventListener("DOMContentLoaded", function() {
    var priceFilter = document.getElementById("priceFilter");
    var priceDisplay = document.getElementById("priceDisplay");
    
    priceFilter.addEventListener("input", function() {
        var price = priceFilter.value + " MAD";
        priceDisplay.textContent = price;
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const preferenceButtons = document.querySelectorAll('.preference-button');
    const selectedPreferencesInput = document.getElementById('selectedPreferences');
    const savePreferencesBtn = document.getElementById('savePreferencesBtn');

    // Add click event listener to each preference button
    preferenceButtons.forEach(button => {
      button.addEventListener('click', function() {
        this.classList.toggle('selected'); // Toggle selected class
        updateSelectedPreferences();
      });
    });

    // Add click event listener to save preferences button
    savePreferencesBtn.addEventListener('click', function() {
      // Save selected preferences
      const selectedPreferences = [];
      preferenceButtons.forEach(button => {
        if (button.classList.contains('selected')) {
          selectedPreferences.push(button.innerText.trim());
        }
      });

      // Display selected preferences in input field
      selectedPreferencesInput.value = selectedPreferences.join(', ');
    });

    // Function to update selected preferences
    function updateSelectedPreferences() {
      const selectedPreferences = [];
      preferenceButtons.forEach(button => {
        if (button.classList.contains('selected')) {
          selectedPreferences.push(button.innerText.trim());
        }
      });

      // Display selected preferences in input field
      selectedPreferencesInput.value = selectedPreferences.join(', ');
    }
  });