<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Create Bus
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Bus </x-slot>
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('buses.index') }}">Bus</a></li>
            <li class="breadcrumb-item active">Create Bus</li>
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('buses.store') }}" method="post" enctype="multipart/form-data">
        <div>
            @csrf

            <x-backend.form.input name="name" type="text" label="Name" />
            <x-backend.form.input name="reg_number" type="text" label="Registration Number" />
            <x-backend.form.input name="no_of_seat" type="number" label="Number of Seat" />
            <div class="form-group">
                <label><strong>Every feature end with using dot'.' in Feature and details field</strong></label>
            </div>
            <x-backend.form.input name="features_details" type="text" label="Features Details" />
            <x-backend.form.input name="other_details" type="text" label="Other Details" />
            <div class="form-group">
                <label><strong> Upload 6 Image for best display</strong></label>
            </div>
            <div class="form-group" id="images">
                <label for="iamges">Image</label>
                <div class="d-flex">
                    <input name="images[]" class="form-control" id="images" type="file">
                    <a class="bg-warning d-flex align-items-center justify-content-center bordered rounded ml-1"
                        style="width: 40px; color: purple" onclick="createInput()"><i class="fa fa-plus"></i></a>
                </div>
            </div>

            <x-backend.form.button>Save</x-backend.form.button>
        </div>
    </form>
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
            aPlus.setAttribute("class",
                "bg-warning d-flex align-items-center justify-content-center bordered rounded ml-1");
            aPlus.setAttribute("style", "width: 40px; color: purple");
            aPlus.setAttribute("onclick", "createInput()");

            const iPlus = document.createElement("i");
            iPlus.setAttribute("class", "fa fa-plus");

            const aDelete = document.createElement("a");
            aDelete.setAttribute("class",
                "bg-danger d-flex align-items-center justify-content-center bordered rounded ml-1");
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
