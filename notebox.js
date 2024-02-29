function loadNote() {
    const savedNote = localStorage.getItem('note');
    if (savedNote) {
        document.getElementById('noteContent').value = savedNote;
    }
}

function saveNote() {
    const noteContent = document.getElementById('noteContent').value;
    if (noteContent.trim() === '') {
        document.getElementById('note-modal-message').innerText = 'Please enter a note before saving.';
        Modal.show('note-modal');
        return;
    }
    localStorage.setItem('note', noteContent);
    document.getElementById('note-modal-message').innerText = 'Note saved successfully.';
    Modal.show('note-modal');
}

// Call the loadNote function when the page loads
window.addEventListener('load', loadNote);