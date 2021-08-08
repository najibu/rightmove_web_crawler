@include('webcrawler.show')

<div class="container mt-3">
    <p>{{ $sold_properties }} sold properties</p>

    <h5>5 most expensive properties sold in the last 10 years</h5>

    @if ($properties->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Address</th>
                        <th>Property Type</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($properties as $property)
                        <tr>
                            <td>{{ $property['address'] }}</td>
                            <td>{{ $property['propertyType'] }}</td>
                            <td>£{{ $property['price'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-danger">No properties found</p>
    @endif
</div>
