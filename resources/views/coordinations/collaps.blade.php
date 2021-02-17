@php
  $category_number = $cloth->category_number;
@endphp
<div class="card">
  <div class="card-header" id="heading{{$category_number}}">
    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$category_number}}" aria-expanded="true" aria-controls="collapse{{$category_number}}">
      {{$category[$category_number]}}
    </button>
  </div>

  <div id="collapse{{$category_number}}" class="collapse show" aria-labelledby="heading{{$category_number}}" data-parent="#accordionExample">
    <div class="card-body">
      <table class="table">
        <thead>
          <tr>
            <th></th>
            <th></th>
            <th>ブランド</th>
            <th>価格</th>
            <th>購入日</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>
              <div class="form-check inline">
                <input class="form-check-input position-static" type="checkbox"  name="cloth_id[]" value="{{$cloth->id}}" >
              </div>
            </th>
            <td>{{$cloth->image}}</td>
            <td>{{$cloth->brand}}</td>
            <td>{{$cloth->price}}円</td>
            <td>{{$cloth->buy_date}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>