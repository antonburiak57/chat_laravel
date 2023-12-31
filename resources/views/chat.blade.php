@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Messages</h2>

            <div
                class="d-flex justify-content-between"
                v-for="message in messages"
            >
                <div class="">@{{ message.user.name }}: @{{ message.message }}</div>
                <div @click="deleteMessage(message.id)">delete</div>
            </div>

            <div class="input-group">
                <input
                    type="text"
                    name="message"
                    class="form-control"
                    placeholder="Type your message here..."
                    v-model="newMessage"
                    @keyup.enter="sendMessage"
                >

                <button
                    class="btn btn-primary"
                    @click="sendMessage"
                >
                    Send
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
