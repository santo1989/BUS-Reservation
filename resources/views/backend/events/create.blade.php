<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Add Form
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Events </x-slot>

            <li class="breadcrumb-item"><a href="{{ route('events.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Add New</li>

        </x-backend.layouts.elements.breadcrumb>
    </x-slot>


    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Create Events <a class="btn btn-sm btn-info" href="{{ route('events.index') }}">List</a>
        </div>
        <div class="card-body">

           <x-backend.layouts.elements.errors :errors="$errors"/>

            <form action="{{ route('events.store') }}" enctype="multipart/form-data" method="post">
                @csrf

                <x-backend.form.input name="name" type="text" label="Title"/>
                
                {{-- <x-backend.form.textarea  /> --}}

                <x-backend.form.textarea name="details" label="Details" >
                </x-backend.form.textarea>

                <x-backend.form.input name="images" type="file" label="images"/>

                
                {{-- <div class="form-group" id="images">
                    <label for="iamges">Image</label>
                    <div class="d-flex">
                        <input name="images[]" class="form-control" id="images" type="file">
                        <a class="bg-warning d-flex align-items-center justify-content-center bordered rounded ml-1" style="width: 40px; color: purple" onclick="createInput()"><i class="fa fa-plus"></i></a>
                    </div>
                </div> --}}
                

                <x-backend.form.button>Save</x-backend.form.button>
            </form>
        </div>
    </div>

    <script>

        const createInput = () => {
            const parent = document.getElementById("images");
            const div = document.createElement("div");
            div.setAttribute('class', 'd-flex mt-2');

            const input = document.createElement("input");
            input.setAttribute("type", "file");
            input.setAttribute("class", "form-control");
            input.setAttribute("name", "images[]");

            const aPlus = document.createElement("a");
            aPlus.setAttribute("class", "bg-warning d-flex align-items-center justify-content-center bordered rounded ml-1");
            aPlus.setAttribute("style", "width: 40px; color: purple");
            aPlus.setAttribute("onclick", "createInput()");
            
            const iPlus = document.createElement("i");
            iPlus.setAttribute("class", "fa fa-plus");

            const aDelete = document.createElement("a");
            aDelete.setAttribute("class", "bg-danger d-flex align-items-center justify-content-center bordered rounded ml-1");
            aDelete.setAttribute("style", "width: 40px; color: black");
            aDelete.setAttribute("onclick", "deleteDiv(this)");
            
            const iDelete = document.createElement("i");
            iDelete.setAttribute("class", "fa fa-trash");


            aPlus.appendChild(iPlus);
            aDelete.appendChild(iDelete);
            div.appendChild(input);
            div.appendChild(aPlus);
            div.appendChild(aDelete);
            parent.appendChild(div);
        }

        // const deleteDiv = (this) => {
        //     const parent = document.getElementById("images");
        //     // parent.removeChild(parent.)
        //     console.log(this);
            


        // }

        let deleteDiv = (e) => {
            e.parentNode.parentNode.removeChild(e.parentNode);
            // console.log(e);
        }


        
            
    </script>


</x-backend.layouts.master>