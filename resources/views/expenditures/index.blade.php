@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Expenditure</div>

                    <div class="card-body">
                        {{-- Display success message --}}
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- Form to add a new expenditure --}}
                        <form action="{{ route('expenditures.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select class="form-control" id="category_id" name="category_id" required>
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label for="item_id">Item</label>
                                <select class="form-control" id="item_id" name="item_id" required>
                                    <option value="">Select an item</option>
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label for="amount">Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount" min="0" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="description">Description (Optional)</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Add Expenditure</button>
                        </form>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">Expenditure List</div>

                    <div class="card-body">
                        @if($expenditures->isEmpty())
                            <p>No expenditures found.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Category Name</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($expenditures as $expenditure)
                                        <tr>
                                            <td>{{ $expenditure->item->name }}</td>
                                            <td>{{ $expenditure->item->itemGroup->name }}</td> <!-- Display the item's category name -->
                                            <td>{{ $expenditure->amount }}</td>
                                            <td>{{ $expenditure->created_at->format('d-m-Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categorySelect = document.getElementById('category_id');
        const itemSelect = document.getElementById('item_id');

        categorySelect.addEventListener('change', function () {
            const categoryId = this.value;

            if (categoryId) {
                itemSelect.innerHTML = '<option value="">Select an item</option>';

                // Perform the AJAX request to fetch items
                fetch(`/items/${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Populate the item dropdown
                        data.forEach(item => {
                            const option = document.createElement('option');
                            option.value = item.id;
                            option.textContent = item.name;
                            itemSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching items:', error));
            } else {
                itemSelect.innerHTML = '<option value="">Select an item</option>';
            }
        });
    });
</script>
@endsection
