<x-app-layout>
    <x-header>
        {{ __('Tasks')}}
    </x-header>

    <div class="flex w-full items-center justify-between">
        {{  html()->form('GET', route('tasks.index'))->open() }}
                {{  html()->select('filter[status_id]', $statusesByIds, $filter['status_id'] ?? 0)->class('rounded border-gray-300')->placeholder('Статус')    }}
                {{  html()->select('filter[created_by_id]', $usersByIds, $filter['created_by_id'] ?? 0)->class('rounded border-gray-300')->placeholder('Автор')    }}
                {{  html()->select('filter[assigned_to_id]', $usersByIds, $filter['assigned_to_id'] ?? 0)->class('rounded border-gray-300')->placeholder('Исполнитель')    }}
                <x-primary-button>
                    {{ __('Accept') }}
                </x-primary-button>
        {{ html()->form()->close()}}
        
        @can('create', App\Models\Task::class)
        <div>
            <x-primary-link href="{{ route('tasks.create') }}">
                {{ __('Create task') }}
            </x-primary-link>
        </div>
        @endcan

    </div>

    <table class="mt-4 dark:text-neutral-200">
        <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>ID</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Author') }}</th>
                <th>{{ __('Executor') }}</th>
                <th>{{ __('Created at') }}</th>
                @can('update', $tasks[0] ?? null)
                    <th>{{ __('Actions')}} </th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr class="border-b border-dashed text-left">
                    <td>{{  $task->id }}</td>
                    <td>{{  $task->status->name   }}</td>
                    <td>
                        <a href="{{ route('tasks.show', $task->id)}}" class="text-blue-700 hover:text-indigo-400">
                            <x-short-inscription>
                                {{  $task->name }}
                            </x-short-inscription>
                        </a></td>
                    <td>{{  $task->author->name }}</td>
                    <td>{{  $task->assignedTo?->name }}</td>
                    <td>{{  $task->created_at->format('d.m.Y') }}</td>                        
                    @can('update', $task)
                        <td>
                            @can('delete', $task)
                                <a data-confirm="Вы уверены?" data-method="delete" class="text-red-600 hover:text-red-900" href="{{ route('tasks.destroy', $task->id)  }}">
                                    {{ __('Delete') }}
                                </a>
                            @endcan
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.edit', $task->id)  }}">
                                {{ __('Change') }}
                            </a>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $tasks->links('pagination::tailwind') }}
    </div>

</x-app-layout>