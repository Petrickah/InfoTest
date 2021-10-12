@extends("UserRoles::index")

@section('utilizatori-section')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h4 class="card-title col-md-8" style="margin-top: 5px;">Toti utilizatorii</h4>
                        <?php

                        use App\Models\User;

                        $users_per_page = 15;
                        $nr_pages = count(User::all())/$users_per_page;
                        $users = User::paginate($users_per_page);
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
                    <form action="/utilizator/{{$username}}" method="post" class="forms-sample">
                        <div class="form-group">
                            <label for="Username"> Username </label>
                            <input type="text" name="Username" class="form-control" placeholder="Username" value="{{$username}}">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4 col-lg-4">
                                <label for="Nume">Nume</label>
                                <input type="text" name="Nume" class="form-control" placeholder="Nume" value="{{$nume}}">
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <label for="Prenume">Prenume</label>
                                <input type="text" name="Prenume" class="form-control" placeholder="Prenume" value="{{$prenume}}">
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <label for="Role">Role (Student/Teacher/Admin)</label>
                                <input type="text" name="Role" class="form-control" placeholder="Student/Teacher/Administrator" value="{{$role}}">
                            </div>
                        </div>
                        <div class="form-group"> </div>
                        <div class="form-group">
                            {!! Form::submit('Actualizeaza', ['class'=>'btn btn-gradient-primary mr-2']) !!}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection