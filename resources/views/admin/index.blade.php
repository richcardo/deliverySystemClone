<x-layout2>
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-12 pt-4">
                <h3>Utenti</h3>
                <table class="table-custom-admin w-75">
                    <thead class="text-black">
                        <th>#</th>
                        <th>name</th>
                        <th>email</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-start">
                                    <a class="btn btn-sm btn-secondary" href="{{ route('admin.edit', $user) }}">Modifica</a>
                                    <form class="d-inline" action=" {{ route('admin.destroy', $user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit">Elimina</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout2>