@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">Messages</div>
                    <input type="text" name="name" id="name"
                           placeholder="Search user" />

                    <div class="card-body" id="app">
                       <chat-app :user="{{ auth()->user() }}"></chat-app>

                        <div id="messages"></div>

                        <form id="message_form">
                            <input type="text" name="message"
                                   id="message_input" placeholder="Write a message" />
                            <button type="submit" id="message_send">Send Message</button>
                        </form>

                        <script src="resources/js/app.js"></script>
                </div>
            </div>
        </div>
    </div>
@endsection
