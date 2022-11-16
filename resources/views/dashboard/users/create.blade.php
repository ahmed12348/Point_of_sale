@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.users')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.users.index') }}"> @lang('site.users')</a></li>
            <li class="active">@lang('site.add')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">@lang('site.add')</h3>
            </div><!-- end of box header -->

            <div class="box-body">

                @include('partials._errors')

                <form action="{{ route('dashboard.users.store') }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('post') }}

                    <div class="form-group">
                        <label>@lang('site.first_name')</label>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}">
                    </div>

                    <div class="form-group">
                        <label>@lang('site.last_name')</label>
                        <input type="text" name="last_name" class="form-control" value="{{ old('first_name') }}">
                    </div>

                    <div class="form-group">
                        <label>@lang('site.email')</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label>@lang('site.image')</label>
                        <input type="file" name="image" class="form-control image">
                    </div>

                    <div class="form-group">
                        <img src="{{ asset('uploads/user_images/default.png') }}" style="width: 100px"
                            class="img-thumbnail image-preview" alt="">
                    </div>

                    <div class="form-group">
                        <label>@lang('site.password')</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>@lang('site.password_confirmation')</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>@lang('site.roles')</label>
                        <select name="roles[]" class="form-control select2" multiple>
                            <option disabled value="">@lang('site.all_roles')</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>@lang('site.permissions')</label>
                            <div class="card">
                                <div class="card-header d-flex p-0">
                                    @php
                                     $models = ['users','categories','products'];
                                    $maps = ['create','read','update','delete'];
                                    @endphp

                                    <ul class="nav nav-pills ml-auto p-2">
{{--                                        <li class="nav-item"><a class="nav-link active" href="#users" data-toggle="tab">@lang('site.users')</a></li>--}}
                                        @foreach($models as  $index => $model)
                             <li class="nav-item {{$index == 0 ?'active': ''}}" ><a class="nav-link " href="#{{$model}}" data-toggle="tab">@lang('site.'.$model)</a></li>
                                        @endforeach
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        @foreach($models as  $index => $model)
                                        <div class="tab-pane {{$index == 0 ? 'active' : ''}}" id="{{$model}}">
                                            @foreach($maps as $map)
                        <label><input type="checkbox" name="permissions[]" value="{{$model}}_{{$map}}">@lang('site.'.$map)</label>
                                            @endforeach
                                         </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                            @lang('site.add')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of box body -->

        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection
