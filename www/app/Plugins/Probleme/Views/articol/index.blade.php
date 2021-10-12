@extends('Probleme::articol')

@section('articol-section')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h4 class="card-title col-md-8" style="margin-top: 5px;">Toate Problemele</h4>
                        <?php
                        $postari_per_page = 15;
                        $nr_pages = count(\App\Models\Postare::all())/$postari_per_page;
                        $articole = \App\Models\Postare::paginate($postari_per_page);
                        ?>
                        @if($nr_pages>1)
                            <?php
                            if(!key_exists('page', $_GET)) $_GET['page'] = 1;
                            $curr_page = (isset($_GET['page']))?($_GET['page']):1;
                            ?>
                            <nav class="col-md-4">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="articol?page=<?php echo ($curr_page==1)?$curr_page:$curr_page-1?>"><i class="mdi mdi-chevron-left"></i></a></li>
                                    @for($i = 1; $i <= $nr_pages; $i++)
                                        <li class="page-item {{$_GET['page']==$i?'active':''}}"><a class="page-link" href="articol?page={{$i}}">{{$i}}</a></li>
                                    @endfor
                                    <li class="page-item <?php echo ($curr_page>$nr_pages)?'active':''?>"><a class="page-link" href="articol?page=<?php echo ($curr_page==$nr_pages)?$curr_page:$curr_page+1?>"><i class="mdi mdi-chevron-right"></i></a></li>
                                </ul>
                            </nav>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> Titlu </th>
                                <th> Autor </th>
                                <th> Categorie </th>
                                <th> Creat la </th>
                                <th> Optiune </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articole as $postare)
                                <tr>
                                    <td> {{$postare->Titlu}} </td>
                                    <td>
                                        <img src="images/faces/{{strtolower(file_exists('images/faces/'.$postare->autor->Username)?$postare->autor->Username:"face1")}}.jpg" class="mr-2" alt="image"> {{$postare->autor->Username}}
                                    </td>
                                    <td>
                                        {{$postare->categorie->Denumire}}
                                    </td>
                                    <td>{{$postare->created_at}}</td>
                                    <td><a href="/problema/{{$postare->slug}}/">Vezi articol</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
