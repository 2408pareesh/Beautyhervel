// Script to auto-fill current date
function setDateTime() {
            let now = new Date();
            let formatted = now.getFullYear() + "-" + 
                            String(now.getMonth() + 1).padStart(2, '0') + "-" + 
                            String(now.getDate()).padStart(2, '0') + " " +
                            String(now.getHours()).padStart(2, '0') + ":" + 
                            String(now.getMinutes()).padStart(2, '0') + ":" + 
                            String(now.getSeconds()).padStart(2, '0');
            document.getElementById("orderDate").value = formatted;
        }

        // first time load panna
        setDateTime();

        // every 1 second ku update panna
        setInterval(setDateTime, 1000);

// Get Product
function selectProduct(name) {
            document.getElementById('productInput').value = name;
            document.getElementById('selectedProduct').innerText = "Selected Product: " + name;
        }
        function setCurrentDate() {
            document.getElementById('orderDate').value = new Date().toLocaleString();
        }
        window.onload = setCurrentDate;

// Set current date/time for order
        document.getElementById('orderDate').value = new Date().toLocaleString();

        // Highlight selected product card
        function updateSelected(input) {
            document.querySelectorAll('.photo-card').forEach(card => card.classList.remove('selected'));
            input.parentElement.classList.add('selected');
        }