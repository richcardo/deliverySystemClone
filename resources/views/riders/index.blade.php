<x-layout>

<div class="container">

    <div class="row justify-content-center px-0 w-100">
            
        <div class="col-10 col-sm-10 col-md-10 mt-5 ">
        
            <div class="mb-2">
                <h3 id="title">I tuoi Rider</h3>
                @if(session()->has('success'))
                    <div class="alert alert-style-success" role="alert">
                    {{ session('success') }}
                    </div>
                @endif
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