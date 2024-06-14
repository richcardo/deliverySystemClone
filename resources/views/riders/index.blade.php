<x-layout>

<div class="container">

    <div class="row justify-content-start px-0 w-100">
            
        <div class="col-12 col-sm-12 col-md-12 m-5 ">
        
            <div class="mb-5">
                <h3 id="title">I tuoi Rider</h3>
                @if(session()->has('success'))
                    <div class="alert alert-style-success" role="alert">
                    {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="mb-3">
                <div class="modale" id="modale-rider" style="display: none;">
                    <div class="testo1">
                        <p>Vuoi Davvero cancellare il Rider ?</p>
                    </div>
                    <div class="options">
                        <button onclick="displayModaleRider()" class="btn btn-sm btn-primary">No!</button>
                        <form action="" method="POST" id="form-delete">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Elimina</button>
                        </form>
                    </div>
                </div>
            </div>
            <livewire:riders-list/>
        </div>
    </div>
</div>
<script>
    var modaleRider = document.getElementById('modale-rider')
    var btnsDeleteRider =document.querySelectorAll('#delete-rider')
    var deleteForm =document.getElementById('form-delete')

    console.log(btnsDeleteRider)
    function displayModaleRider(){
        
        if(modaleRider.style.display=='none'){
            modaleRider.style.display='block'
        }else {
            modaleRider.style.display='none'
        }

    }

    for( btn of btnsDeleteRider){
        btn.addEventListener('click', e =>{
            const action = e.target.getAttribute('data-action');
            deleteForm.setAttribute('action', action)
        })
    }

</script>
</x-layout>