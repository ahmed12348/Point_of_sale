@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.users')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.users.index') }}"> @lang('site.users')</a></li>
            <li class="active">@lang('site.edit')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">@lang('site.edit')</h3>
            </div><!-- end of box header -->

            <div class="box-body">

                @include('partials._errors')

                <form action="{{ route('dashboard.users.update', $user->id) }}" method="post"
                    enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('put') }}

                    <div class="form-group">
                        <label>@lang('site.first_name')</label>
                        <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}">
                    </div>

                    <div class="form-group">
                        <label>@lang('site.email')</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                    </div>

{{--                    <div class="form-group">--}}
{{--                        <label>@lang('site.image')</label>--}}
{{--                        <input type="file" name="image" class="form-control image">--}}
{{--                    </div>--}}

{{--                    <div class="form-group">--}}
{{--                        <img src="{{ $user->image_path }}" style="width: 100px" class="img-thumbnail image-preview"--}}
{{--                            alt="">--}}
{{--                    </div>--}}

                    <div class="form-group">
                        <label>@lang('site.roles')</label>
                        <select name="roles[]" class="form-control select2" multiple> @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                {{ $role->name }}</option>
                            @endforeach
                        </select> </div>

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
                                                <label><input type="checkbox" name="permissions[]"
                                               {{$user->hasPermission($model.'_'.$map) ? 'checked' : '' }}    value="{{$model}}_{{$map}}">@lang('site.'.$map)

                                                </label>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>
                            @lang('site.edit')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of box body -->

        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection
