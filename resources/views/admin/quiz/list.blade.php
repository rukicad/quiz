<x-app-layout>
    <x-slot name="header">Quizler</x-slot>
    <div class="card">
        <div class="card-body">
        <h5 class= "card-title float-right"> <br></br>
                <a href="{{route('quizzes.create')}}" class="btn btn-sm btn-primary" style="float:right" ><i class="fa fa-plus"></i>
                Quiz Oluştur</a>
            </h5>
              <form method="GET" action="">
                <div class="form-row">
                <div class="col-md-4">
                  <input type="text" name="title" value="{{ request()->get('title') }}" placeholder="Quiz Adı" class="form-control">
                </div>
                <div class="col-md-4">
                  <select class="form-control" onchange="this.form.submit()" name="status" style="float:right">
                    <option value="">Durum Seçiniz</option>
                    <option @if(request()->get('status')=='publish') selected @endif value="publish">Aktif</option>
                    <option @if(request()->get('status')=='passive') selected @endif value="passive">Pasif</option>
                    <option @if(request()->get('status')=='draft') selected @endif value="draft">Taslak</option>
                  </select>  
                <br></br>
                </div>
                @if(request()->get('title') || request()->get('status'))
                  <div class="col-md-2">
                  <a href="{{route('quizzes.index')}}" class="btn btn-secondary btn-sm">Sıfırla</a>
                  </div>
                @endif
                </div>
              </form>
      <table class="table table-bordered">
      <thead><br>
    <tr>
      <th scope="col">Quiz</th>
      <th scope="col">Soru Sayısı</th>
      <th scope="col">Durum</th>
      <th scope="col">Bitiş Tarihi</th>
      <th scope="col">İşlemler</th>
    </tr>
  </thead>
  <tbody>
    @foreach($quizzes as $quiz)
    <tr>
      <td> {{ $quiz->title }} </td>
      <td> {{ $quiz->questions_count }} </td>
      <td> 
           @switch($quiz->status)
           @case('publish')
               <span class="btn btn-success">Aktif</span> 
           @break
           @case('passive')
                <span class="btn btn-danger" >Pasif</span>
           @break 
           @case('draft')
                <span class="btn btn-warning">Taslak</span>
           @break
           @endswitch
      </td>
      <td>
        <span title="{{$quiz->finished_at}}">
          {{$quiz->finished_at ? $quiz->finished_at->diffForHumans() : '-'}} </span>
      </td>
      <td>
        <a href=" {{route('questions.index',$quiz->id)}} " class="btn btn-sm btn-warning">
          <i class="fa fa-question"></i></a>
        <a href=" {{route('quizzes.edit',$quiz->id)}} " class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
        <a href=" {{route('quizzes.destroy',$quiz->id)}} " class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
      </td>
    </tr>
    @endforeach
</tbody>
</table>
      <td>{{$quizzes->withQueryString()->links()}}</td>
        </div>
    </div>
</x-app-layout>