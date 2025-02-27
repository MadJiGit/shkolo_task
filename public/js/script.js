document.addEventListener("DOMContentLoaded", function () {

    // Handle edit button click
    const editButtons = document.querySelectorAll(".extra-button");
    editButtons.forEach(button => {
        button.addEventListener("click", function () {
            const buttonId = this.getAttribute("data-edit-id");
            window.location.href = `index.php?action=edit&id=${buttonId}`;
        });
    });

    // Handle delete button click
    const deleteButtons = document.querySelectorAll(".delete-button");
    deleteButtons.forEach(button => {
        button.addEventListener("click", function () {
            const buttonId = this.getAttribute("data-id");
            if (confirm("Are you sure you want to delete this button?")) {
                window.location.href = `index.php?action=clear&id=${buttonId}`;
            }
        });
    });

    // Handle back button click
    const backButton = document.querySelector(".back-button");
    if (backButton) {
        backButton.addEventListener("click", function () {
            window.location.href = "index.php";
        });
    }

    // Error message handling
    const errorMessage = document.getElementById("errorMessage");
    if (errorMessage) {
        setTimeout(() => {
            errorMessage.style.display = "none";
        }, 3000); // Hide error after 3 seconds
    }
});
