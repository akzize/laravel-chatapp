@extends('messages.index')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
@endsection

@section('content')
    <div class="ccontainer">
        <div class="crow">
            {{-- <nav class="menu">
                <ul class="items">
                    <li class="item">
                        <i class="fa fa-home" aria-hidden="true"></i>
                    </li>
                    <li class="item">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </li>
                    <li class="item">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </li>
                    <li class="item item-active">
                        <i class="fa fa-commenting" aria-hidden="true"></i>
                    </li>
                    <li class="item">
                        <i class="fa fa-file" aria-hidden="true"></i>
                    </li>
                    <li class="item">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                    </li>
                </ul>
            </nav> --}}

            <section class="discussions">
                <div class="discussion search">
                    <div class="searchbar">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        <input type="text" placeholder="Search..."></input>
                    </div>
                </div>
                <div class="contacts">
                    {{-- to chow my contacts passed from controller --}}

                    @foreach ($contacts as $cnt)
                        <div class="discussion" data-reciever="{{ $cnt->id }}">
                            <div class="photo"
                                style="background-image: url(https://i.pinimg.com/originals/a9/26/52/a926525d966c9479c18d3b4f8e64b434.jpg);">
                                <div class="online"></div>
                            </div>
                            <div class="desc-contact">
                                <p class="name">{{ $cnt->name }}</p>
                                <p class="message">Let's meet for a coffee or something today ?</p>
                            </div>
                            <div class="timer">3 min</div>
                        </div>
                    @endforeach
                    {{-- <div class="discussion message-active" data-reciever="1">
                        <div class="photo"
                            style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
                            <div class="online"></div>
                        </div>
                        <div class="desc-contact">
                            <p class="name">Megan Leib</p>
                            <p class="message">9 pm at the bar if possible 😳</p>
                        </div>
                        <div class="timer">12 sec</div>
                    </div> --}}


                </div>
            </section>
            <section class="chat">
                <div class="header-chat">
                    <i class="icon fa fa-user-o" aria-hidden="true"></i>
                    <p class="name">Megan Leib</p>
                    {{-- <i class="icon clickable fa fa-ellipsis-h right" aria-hidden="true"></i> --}}
                </div>
                <div class="chat-messages">
                    <div class="messages-chat" id="messages-chat">
                        <div class="message">
                            <div class="photo"
                                style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
                                <div class="online"></div>
                            </div>
                            <p class="text"> Hi, how are you ? </p>
                        </div>
                        <div class="message text-only">
                            <p class="text"> What are you doing tonight ? Want to go take a drink ?</p>
                        </div>
                        <div class="message text-only">
                            <p class="text"> What are you doing tonight ? Want to go take a drink ?</p>
                        </div>
                        <p class="time"> 14h58</p>
                        <div class="message text-only">
                            <div class="response">
                                <p class="text"> Hey Megan ! It's been a while 😃</p>
                            </div>
                        </div>
                        <div class="message text-only">
                            <div class="response">
                                <p class="text"> When can we meet ?</p>
                            </div>
                        </div>
                        <p class="response-time time"> 15h04</p>
                        <div class="message">
                            <div class="photo"
                                style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
                                <div class="online"></div>
                            </div>
                            <p class="text"> 9 pm at the bar if possible 😳</p>
                        </div>
                        <p class="time"> 15h09</p>
                    </div>
                    <div class="footer-chat">
                        <i class="icon fa fa-smile-o clickable" style="font-size:25pt;" aria-hidden="true"></i>
                        <input type="text" class="write-message" id="write-message" placeholder="Type your message here"></input>
                        <i class="icon send fas fa-paper-plane clickable" aria-hidden="true" id="send_message_btn"></i>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/chat.js') }}"></script>
@endsection
