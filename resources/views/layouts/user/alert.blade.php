<div id="alert-message" class="alert hidden">
    <span id="alert-text"></span>
    <button id="close-alert" class="close-btn">&times;</button>
</div>


<style>
/* General styles for the alert */
.alert {
    position: fixed;
    top: 20px;
    right: 20px;
    background-color: #28a745; /* Green for success */
    color: white;
    padding: 15px 25px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    font-size: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 9999;
    transition: opacity 0.5s ease-in-out;
    opacity: 0;
}

.alert.success {
    background-color: #28a745; /* Green for success */
}

.alert.error {
    background-color: #dc3545; /* Red for error */
}

.alert.warning {
    background-color: #ffc107; /* Yellow for warnings */
}

.alert.info {
    background-color: #17a2b8; /* Blue for info */
}

.close-btn {
    background: none;
    border: none;
    color: white;
    font-size: 20px;
    cursor: pointer;
}

.hidden {
    display: none;
}

/* Animation for showing and hiding the alert */
.alert.show {
    opacity: 1;
}

</style>