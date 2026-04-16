// Preview uploaded image
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    const previewContainer = preview.parentElement;
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.classList.add('show');
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Multi-step form navigation
let currentStep = 1;

function nextStep(step) {
    document.getElementById(`step-${step}`).classList.remove('active');
    document.getElementById(`step-${step + 1}`).classList.add('active');
    
    // Update step indicator
    document.querySelectorAll('.step-indicator')[step - 1].querySelector('div').classList.remove('border-gray-300');
    document.querySelectorAll('.step-indicator')[step - 1].querySelector('div').classList.add('border-gray-900');
    document.querySelectorAll('.step-indicator')[step - 1].querySelector('span').classList.remove('text-gray-500');
    document.querySelectorAll('.step-indicator')[step - 1].querySelector('span').classList.add('text-gray-900');
    
    document.querySelectorAll('.step-indicator')[step].querySelector('div').classList.remove('border-gray-300');
    document.querySelectorAll('.step-indicator')[step].querySelector('div').classList.add('border-gray-900');
    document.querySelectorAll('.step-indicator')[step].querySelector('span').classList.remove('text-gray-500');
    document.querySelectorAll('.step-indicator')[step].querySelector('span').classList.add('text-gray-900');
    
    currentStep = step + 1;
}

function prevStep(step) {
    document.getElementById(`step-${step}`).classList.remove('active');
    document.getElementById(`step-${step - 1}`).classList.add('active');
    
    // Update step indicator
    document.querySelectorAll('.step-indicator')[step - 1].querySelector('div').classList.remove('border-gray-900');
    document.querySelectorAll('.step-indicator')[step - 1].querySelector('div').classList.add('border-gray-300');
    document.querySelectorAll('.step-indicator')[step - 1].querySelector('span').classList.remove('text-gray-900');
    document.querySelectorAll('.step-indicator')[step - 1].querySelector('span').classList.add('text-gray-500');
    
    currentStep = step - 1;
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.matches('.dropdown-menu') && !event.target.closest('[onclick*="toggleDropdown"]')) {
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.classList.remove('show');
        });
    }
});