@extends('layouts.app')
@section('content')
    <div class="row no-gutters">
        <div class="col-sm-12">
            <h1 class="m-4">Announcement</h1>
        </div>
        <div class="col-sm-6 my-2">
            <div class="card mx-4 p-4 shadow bg-dark text-white">
                <div class="card-content" style="display: flex; flex-direction: column; gap: 16px;">
                    <div style="display: flex; gap: 16px;">
                        <div class="rounded-circle" style="width: 64px; height: 64px; background-color: red; display: flex; justify-content: center; align-items: center;">
                            <h3 style="margin: 0;">J</h3>
                        </div>
                        <div style="display: flex; flex-direction: column; justify-content: center;">
                            <h3 style="margin: 0;">Joseph Chua <span class="badge badge-pill badge-small bg-primary" style="font-size: 12pt;">Mayor</span></h3>
                            <small>2 minutes ago</small>
                        </div>
                    </div>
                    <div>
                        <p style="margin: 0;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cum repellendus amet optio at, soluta, quis earum non quos vitae a iusto quam neque, doloribus adipisci! Eligendi iusto veritatis ratione accusantium?</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-sm-12">
            <h1 class="m-4">Recent Admin Posts</h1>
        </div>
        <div class="col-sm-6 my-2">
            <div class="card mx-4 p-4 shadow border-primary">
                <div class="card-content" style="display: flex; flex-direction: column; gap: 16px;">
                    <div style="display: flex; gap: 16px;">
                        <div class="rounded-circle text-white" style="width: 64px; height: 64px; background-color: purple; display: flex; justify-content: center; align-items: center;">
                            <h3 style="margin: 0;">D</h3>
                        </div>
                        <div style="display: flex; flex-direction: column; justify-content: center;">
                            <h3 style="margin: 0;">Darwin Marcello <span class="text-white badge badge-pill badge-small bg-warning" style="font-size: 12pt;">Brg. Tanod</span></h3>
                            <small>5 minutes ago</small>
                        </div>
                    </div>
                    <div>
                        <p style="margin: 0;">May nahuli sa curfew. Please wag matigas mga ulo niyo.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
