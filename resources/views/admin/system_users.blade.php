@extends('layouts.admin.navigation')

@section('title', 'System Users')

@section('content')
<div class="container-fluid mt-4">
  <div class="card shadow-lg border-0 rounded-4">
    <div class="card-body p-4">
      @include('admin.partials.system_users.system_user_title')
        @include('admin.partials.system_users.system_user_add-users-button')
        @include('admin.partials.system_users.system_user_add_modal')
        @include('admin.partials.alert')
        @include('admin.partials.system_users.system_user_table')
    </div>
  </div>
</div>
@endsection
