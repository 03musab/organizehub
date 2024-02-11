document.addEventListener('DOMContentLoaded', function () {
    const taskForm = document.getElementById('task-form');
    const taskInput = document.getElementById('task-input');
    const taskList = document.getElementById('task-list');

    // Fetch tasks when the page loads
    fetchTasks();

    // Add task
    taskForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const taskText = taskInput.value.trim();
        if (taskText !== '') {
            saveTask('', taskText); // Save task without ID (add new task)
            const taskItem = createTaskItem('', taskText); // Pass empty ID for new task
            taskList.appendChild(taskItem);
            taskInput.value = '';
        }
    });

    // Create task item
    function createTaskItem(id, text) {
        const taskItem = document.createElement('li');
        taskItem.classList.add('task-item');

        // Set task ID and original text as data attributes
        taskItem.setAttribute('data-id', id);
        taskItem.setAttribute('data-original-text', text);

        // Create task text element
        const taskTextElement = document.createElement('span');
        taskTextElement.textContent = text;
        taskItem.appendChild(taskTextElement);

        // Create edit button
        const editButton = document.createElement('button');
        editButton.textContent = 'Edit';
        editButton.classList.add('edit');
        editButton.addEventListener('click', function () {
            const newText = prompt('Enter new task text:', taskTextElement.textContent);
            if (newText !== null) {
                taskTextElement.textContent = newText;
                const taskId = taskItem.getAttribute('data-id'); // Get task ID from data attribute of task item
                saveEditedTask(taskId, newText); // Save edited task to database
            }
        });
        taskItem.appendChild(editButton);

        // Create delete button
        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete';
        deleteButton.addEventListener('click', function () {
            const confirmDelete = confirm('Are you sure you want to delete this task?');
            if (confirmDelete) {
                taskItem.remove();
                const taskId = taskItem.getAttribute('data-id'); // Get task ID from data attribute
                deleteTask(taskId); // Delete task from database
            }
        });
        taskItem.appendChild(deleteButton);

        return taskItem;
    }

    // Fetch tasks from the server
    function fetchTasks() {
        fetch('get_tasks.php')
            .then(response => response.json())
            .then(tasks => {
                tasks.forEach(task => {
                    const taskItem = createTaskItem(task.id, task.task_text);
                    taskList.appendChild(taskItem);
                });
            })
            .catch(error => console.error('Error fetching tasks:', error));
    }

    // Save task to database
    function saveTask(id, taskText) {
        // Construct the request body
        const requestBody = {
            id: id,
            task_text: taskText
        };

        // Send a POST request to the server to save the task
        fetch('save_task.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(requestBody)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to save task');
            }
            return response.json(); // Parse the response body as JSON
        })
        .then(data => {
            console.log('Task saved successfully:', data);
            location.reload(); // Reload the page after the task is saved

            // Handle any additional logic after saving the task if needed
        })
        .catch(error => {
            console.error('Error saving task:', error);
            // Handle errors gracefully
        });
    }

    // Save edited task to database
    // Save edited task to database
function saveEditedTask(id, newText) {
    fetch('edit_task.php', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: id, task_text: newText })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Failed to save edited task');
        }
        return response.json();
    })
    .then(data => {
        console.log('Task edited successfully:', data);
    })
    .catch(error => {
        console.error('Error saving edited task:', error);
    });
}


    // Delete task from database
    function deleteTask(id) {
        fetch('delete_task.php?id=' + id, { method: 'DELETE' })
            .then(response => {
                if (response.ok) {
                    console.log('Task with ID', id, 'deleted from database');
                } else {
                    console.error('Error deleting task with ID', id, 'from database:', response.status);
                }
            })
            .catch(error => console.error('Error deleting task with ID', id, 'from database:', error));
    }
});
