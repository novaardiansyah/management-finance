@extends('layouts.Main')

@section('content')
  <div class="row">
    <div class="col-md-4">
      <div class="info-box">
        <span class="info-box-icon bg-info"><i class="fa fa-fw fa-wallet"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Cash Balance</span>
          <span class="info-box-number">1,410</span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    {{-- col-md --}}

    <div class="col-md-4">
      <div class="info-box">
        <span class="info-box-icon bg-success"><i class="fa fa-fw fa-wallet"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Bank Balance</span>
          <span class="info-box-number">1,410</span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    {{-- col-md --}}

    <div class="col-md-4">
      <div class="info-box">
        <span class="info-box-icon bg-primary"><i class="fa fa-fw fa-wallet"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">E-Money Balance</span>
          <span class="info-box-number">1,410</span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    {{-- col-md --}}
  </div>

  <div class="row justify-content-center">
    <div class="col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-primary"><i class="fa fa-fw fa-book"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Financial Position Report</span>
          <span class="info-box-number">1,410</span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    {{-- col-md --}}

    <div class="col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-fuchsia"><i class="fa fa-fw fa-book"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Profit and Loss Report</span>
          <span class="info-box-number">1,410</span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    {{-- col-md --}}

    <div class="col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-info"><i class="fa fa-fw fa-book"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Expense and Income Report</span>
          <span class="info-box-number">1,410</span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    {{-- col-md --}}
  </div>

  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="info-box">
        <span class="info-box-icon bg-purple"><i class="fa fa-fw fa-wallet"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Receivable Balance</span>
          <span class="info-box-number">1,410</span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    {{-- col-md --}}

    <div class="col-md-4">
      <div class="info-box">
        <span class="info-box-icon bg-maroon"><i class="fa fa-fw fa-wallet"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Payable Balance</span>
          <span class="info-box-number">1,410</span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    {{-- col-md --}}

    <div class="col-md-4">
      <div class="info-box">
        <span class="info-box-icon bg-indigo"><i class="fa fa-fw fa-wallet"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Loan Repayment Balance</span>
          <span class="info-box-number">1,410</span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    {{-- col-md --}}
  </div>
@endsection
