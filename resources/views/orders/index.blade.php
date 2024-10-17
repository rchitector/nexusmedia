@extends('layouts.app')

@section('title', 'Orders list')

@section('content')
    <div id="app-page">
        <div id="app-content">
            <div class="page-layout">
                <div class="page-layout-content">
                    <div class="container-fluid">
                        <div class="page-layout-header"><!-- to have border-bottom use class "bordered" -->
                            <div class="page-header-inner">
                                <div class="header-inner-left">
                                    <h1 class="page-layout-title">Orders list</h1>
                                </div>
                                <div class="header-inner-right hidden-list-holder">
                                    <a href="{{route('orders.import')}}" class="btn btn-primary">Import data</a>
                                </div>
                            </div> <!-- page-header-inner -->
                        </div><!-- page-layout-header -->
                        <div class="card">
                            @if(empty($orders->count()))
                                <div class="card-section">
                                    <h3 class="card-subtitle">No data</h3>
                                </div>
                            @else
                                <div class="index-table-wrapper">
                                    <div class="index-table-header">
                                        <div class="index-table-header-filter">
                                            <div class="col-left">
                                                <div class="resptabs tabs3">
                                                    @include('orders.partials.filters')
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- index-table-header -->
                                    <div class="index-table-inner table-responsive sticky-left sticky-top">
                                        <div class="index-table-header-action">
                                            <div class="index-table-header-inner">
                                                <div class="form-checkbox">
                                                    <label>
                                                        <input type="checkbox">
                                                        <span class="checkbox-icon"></span>
                                                        <span class="label-text">2 Selected</span>
                                                    </label>
                                                </div>
                                                <button class="link">Cancel</button>
                                            </div>
                                        </div>

                                        <table class="index-table">
                                            <thead>
                                            <tr>
                                                <th>Customer Name</th>
                                                <th>Email</th>
                                                <th>Total Price</th>
                                                <th>Financial Status</th>
                                                <th>Fulfillment Status</th>
                                            </tr>
                                            </thead>
                                            <tbody id="orders-container">
                                            @include('orders.partials.list')
                                            </tbody>
                                        </table>


                                    </div>
                                    <div class="index-table-footer" id="pagination-links">
                                        @include('orders.partials.pagination')
                                    </div>
                                </div> <!-- index-table-wrapper -->
                            @endif
                        </div> <!-- card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection