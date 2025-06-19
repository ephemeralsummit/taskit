<x-layout>
    <br><br><br>
    <div class="container mx-auto pt-lg-5 mt-lg-5" width="700px">
        <p class="mb-0 text-white text-center mb-2" style="font-size: 65px">TaskIt!</p>
        <div class="d-flex justify-content-between align-items-center mx-auto mt-lg-5" style="max-width: 600px;">
            <p class="h2 mb-0 text-white" style="padding-left:50px">Hello {{ auth()->user()->name }}! Here's your tasks.</p>

            <div class="dropdown" style="padding-right:40px">
                <button class="btn text-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg width="20" height="24" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                    </svg>
                </button>
                <ul class="dropdown-menu dropdown-menu-dark bg-dark">
                    <li><a class="dropdown-item" href="/profile/{{ auth()->user()->id }}">Edit Profile</a></li>
                    <li><hr class="dropdown-divider border-top border-secondary"></li>
                    <li><a class="dropdown-item text-danger" href="/logout">Logout</a></li>
                </ul>
            </div>
        </div>

        
        <div class="mx-auto mt-lg-5 blog-card blog-content" style="width:700px">
            <table class="table table_custom">
                <tbody>
                    @foreach ($my_task as $key => $task)
                    <tr>
                        <td style="width:50px">
                            <form action="/dashboard/{{ $task->id }}" method="post" class="">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm text-white" type="submit" style="background-color:#da6fd5;">
                                    <i class="fa fa-lg fa-check"></i>
                                </button>
                            </form>
                        </td>
                        <td class="text-white justify-content-start" style="position:relative">
                            <span class="task-text" data-id="{{ $task->id }}">{{ $task->tasks }}</span>
                            <input type="text" class="form-control task-input d-none" data-id="{{ $task->id }}" value="{{ $task->tasks }}">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
             <div id="new-task-container" class="pb-2" style="width: 620px;padding-left:3.9rem;" >
                <input type="text" id="new-task-input" class="form-control task-input text-white bg-transparent border-light new-task-input input-custom" placeholder="New Task..." autocomplete="off">
            </div>
        </div>
    </div>

<script>
    // i dont even know if this makes sense but it does,
    // i dont wanna touch it and i'll leave it be
    // lets ignore this and move on
document.getElementById('new-task-input').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        const newTask = this.value.trim();

        if (!newTask) return;

        fetch('/dashboard', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                tasks: newTask,
                user_id: {{ auth()->user()->id }}
            })
        })
        .then(response => response.json())
        .then(data => {
            // Reset input
            this.value = '';

            // Append new task to table
            const tableBody = document.querySelector('table tbody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td style="width:50px">
                    <form action="/dashboard/${data.id}" method="post" class="">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm text-white" type="submit" style="background-color:#da6fd5;">
                            <i class="fa fa-lg fa-check"></i>
                        </button>
                    </form>
                </td>
                <td class="text-white justify-content-start" style="position:relative">
                    <span class="task-text" data-id="${data.id}">${data.tasks}</span>
                    <input type="text" class="form-control task-input d-none" data-id="${data.id}" value="${data.tasks}">
                </td>
            `;
            tableBody.appendChild(newRow);

            // Re-bind inline edit events for the new task
            rebindInlineEvents();
        })
        .catch(() => alert('Failed to add task.'));
    }
});

function rebindInlineEvents() {
    document.querySelectorAll('.task-text').forEach(span => {
        span.removeEventListener('click', span._clickHandler);
        span._clickHandler = function () {
            const id = this.dataset.id;
            const input = document.querySelector(`.task-input[data-id="${id}"]`);
            this.classList.add('d-none');
            input.classList.remove('d-none');
            input.focus();
        };
        span.addEventListener('click', span._clickHandler);
    });

    document.querySelectorAll('.task-input:not(.new-task-input)').forEach(input => {
        input.removeEventListener('blur', input._blurHandler);
        input._blurHandler = function () {
            const id = this.dataset.id;
            const newValue = this.value;
            const span = document.querySelector(`.task-text[data-id="${id}"]`);

            fetch(`/tasks/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ tasks: newValue })
            })
            .then(response => {
                if (response.ok) {
                    span.textContent = newValue;
                } else {
                    alert('Update failed.');
                }
                span.classList.remove('d-none');
                this.classList.add('d-none');
            })
            .catch(() => {
                alert('An error occurred.');
                span.classList.remove('d-none');
                this.classList.add('d-none');
            });
        };
        input.addEventListener('blur', input._blurHandler);
    });
}

// Initial bind on load
rebindInlineEvents();
</script>


</x-layout>