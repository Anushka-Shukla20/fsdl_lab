/* ================= REGEX PATTERNS ================= */
const namePattern = /^[A-Za-z ]{3,}$/;
const emailPattern = /^[a-zA-Z]+@[a-zA-Z]{3}\.[a-zA-Z]{2,3}$/;
const phonePattern = /^[0-9]{10}$/;
const passwordPattern = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[&$#@]).{7,}$/;

/* ================= INPUT ELEMENTS ================= */
const nameInput = document.getElementById("name");
const emailInput = document.getElementById("email");
const phoneInput = document.getElementById("phone");
const ageInput = document.getElementById("age");
const passwordInput = document.getElementById("password");
const confirmInput = document.getElementById("confirmPassword");
const termsInput = document.getElementById("terms");

/* ================= ERROR ELEMENTS ================= */
const nameError = document.getElementById("nameError");
const emailError = document.getElementById("emailError");
const phoneError = document.getElementById("phoneError");
const ageError = document.getElementById("ageError");
const passwordError = document.getElementById("passwordError");
const confirmError = document.getElementById("confirmError");
const termsError = document.getElementById("termsError");
const finalMsg = document.getElementById("finalMsg");

/* ================= HELPER FUNCTION ================= */
function setValidationStyle(input, isValid) {
    if (isValid) {
        input.classList.add("valid");
        input.classList.remove("invalid");
    } else {
        input.classList.add("invalid");
        input.classList.remove("valid");
    }
}

/* ================= LIVE VALIDATION ================= */

nameInput.addEventListener("input", () => {
    const isValid = namePattern.test(nameInput.value.trim());
    nameError.innerHTML = isValid ? "" : "Name must contain at least 3 letters";
    setValidationStyle(nameInput, isValid);
});

emailInput.addEventListener("input", () => {
    const isValid = emailPattern.test(emailInput.value.trim());
    emailError.innerHTML = isValid ? "" : "Invalid email format";
    setValidationStyle(emailInput, isValid);
});

phoneInput.addEventListener("input", () => {
    const isValid = phonePattern.test(phoneInput.value.trim());
    phoneError.innerHTML = isValid ? "" : "Phone number must be 10 digits";
    setValidationStyle(phoneInput, isValid);
});

ageInput.addEventListener("input", () => {
    const age = ageInput.value.trim();
    const isValid = !isNaN(age) && age >= 18 && age <= 60;
    ageError.innerHTML = isValid ? "" : "Age must be between 18 and 60";
    setValidationStyle(ageInput, isValid);
});

passwordInput.addEventListener("input", () => {
    const isValid = passwordPattern.test(passwordInput.value.trim());
    passwordError.innerHTML = isValid
        ? ""
        : "Password must contain capital, digit & special character";
    setValidationStyle(passwordInput, isValid);
});

confirmInput.addEventListener("input", () => {
    const isValid =
        confirmInput.value === passwordInput.value &&
        confirmInput.value !== "";
    confirmError.innerHTML = isValid ? "" : "Passwords do not match";
    setValidationStyle(confirmInput, isValid);
});

termsInput.addEventListener("change", () => {
    termsError.innerHTML = termsInput.checked ? "" : "You must agree to the terms";
});

/* ================= SUBMIT VALIDATION ================= */

document.getElementById("submitBtn").addEventListener("click", () => {

    const isValid =
        namePattern.test(nameInput.value.trim()) &&
        emailPattern.test(emailInput.value.trim()) &&
        phonePattern.test(phoneInput.value.trim()) &&
        !isNaN(ageInput.value) &&
        ageInput.value >= 18 &&
        ageInput.value <= 60 &&
        passwordPattern.test(passwordInput.value.trim()) &&
        confirmInput.value === passwordInput.value &&
        termsInput.checked;

    if (isValid) {
        finalMsg.style.color = "green";
        finalMsg.innerHTML = "✅ Registration Successful";
    } else {
        finalMsg.style.color = "red";
        finalMsg.innerHTML = "❌ Please correct the highlighted errors";
    }
});

/* ================= jQuery ENHANCEMENTS ================= */

$(document).ready(function () {

    // Change button text
    $("#submitBtn").text("Register Now");

    // Add attributes
    $("#phone").attr("maxlength", "10");
    $("#age").attr("maxlength", "2");

    // Access form data
    $("#submitBtn").click(function () {
        console.log("Registered Name:", $("#name").val());
    });
});
