@extends('admin.layouts.layoutnew_admin')
@php
header("Cache-Control", "no-cache, no-store, must-revalidate");
@endphp

@section('topbar')
<!-- begin top dashboard -->
{{-- <div class="dashboard-top">
    <div class="container-fluid">
        <div class="top-entry">
            <div class="top-status">
                <h3>{!! isset($title_page)?$title_page:'&nbsp'; !!}</h3>
                <!-- for single action page remove this breadcrumb-->
                <nav class="dashboard-breadcrumb">
                    <ul class="list-unstyled">
                        <li>
                            <a href="index.html">
                                <i class="mdi mdi-home"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <i class="mdi mdi-chevron-right"></i>
                                {!! isset($title_page)?$title_page:'&nbsp;'; !!}
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="top-option">
                {!! date('d-m-Y') !!}
            </div>
        </div>
    </div>
</div> --}}
<!-- end top dashboard -->
@endsection


@section('content')
<div class="dashboard-chat">
        <div class="chat-box">
          <aside class="chat-list">
           <div class="side-chat-wrap">
             <div class="top-chat">
               <div class="top-chat-content">
                 <h3>Chat</h3>
                 <div class="top-chat-option">
                   <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#chat-search" aria-expanded="false" aria-controls="chat-search">
                     <i class="icon-search"></i>
                   </button>
                   <span class="badge badge-light">10 New</span>

                 </div>
               </div>
               <div class="collapse" id="chat-search">
                <div class="chart-search">
                  <input type="text" class="form-control" placeholder="search chat">
                </div>
               </div>
             </div>
             <div class="side-chat">
               <ul class="chat-user list-unstyled">
                 <li class="btn-toggle-list">
                   <div class="chat-user-list">
                     <div class="chat-img">
                       <img src="images/profile.jpg" alt="" class="img-responsive">
                     </div>
                     <div class="chat-short">
                       <div class="chat-short-top">
                         <h4>Ask mall in west java</h4>
                         <span class="chat-date">
                           <i class="mdi mdi-calendar"></i>
                           Dec 10
                         </span>
                       </div>
                       <p>A shopping mall is a modern term for a form of shopping precinct or shopping center </p>
                     </div>

                   </div>
                 </li>
                 <li class="btn-toggle-list">
                   <div class="chat-user-list">
                     <div class="chat-img">
                       <img src="images/profile.jpg" alt="" class="img-responsive">
                     </div>
                     <div class="chat-short">
                       <div class="chat-short-top">
                         <h4>Ask mall in west java</h4>
                         <span class="chat-date">
                           <i class="mdi mdi-calendar"></i>
                           Dec 10
                         </span>
                       </div>
                       <p>A shopping mall is a modern term for a form of shopping precinct or shopping center </p>
                     </div>

                   </div>
                 </li>
                 <li class="btn-toggle-list">
                   <div class="chat-user-list">
                     <div class="chat-img">
                       <img src="images/profile.jpg" alt="" class="img-responsive">
                     </div>
                     <div class="chat-short">
                       <div class="chat-short-top">
                         <h4>Ask mall in west java</h4>
                         <span class="chat-date">
                           <i class="mdi mdi-calendar"></i>
                           Dec 10
                         </span>
                       </div>
                       <p>A shopping mall is a modern term for a form of shopping precinct or shopping center </p>
                     </div>

                   </div>
                 </li>
                 <li class="btn-toggle-list">
                   <div class="chat-user-list">
                     <div class="chat-img">
                       <img src="images/profile.jpg" alt="" class="img-responsive">
                     </div>
                     <div class="chat-short">
                       <div class="chat-short-top">
                         <h4>Ask mall in west java</h4>
                         <span class="chat-date">
                           <i class="mdi mdi-calendar"></i>
                           Dec 10
                         </span>
                       </div>
                       <p>A shopping mall is a modern term for a form of shopping precinct or shopping center </p>
                     </div>

                   </div>
                 </li>
                 <li class="btn-toggle-list">
                   <div class="chat-user-list">
                     <div class="chat-img">
                       <img src="images/profile.jpg" alt="" class="img-responsive">
                     </div>
                     <div class="chat-short">
                       <div class="chat-short-top">
                         <h4>Ask mall in west java</h4>
                         <span class="chat-date">
                           <i class="mdi mdi-calendar"></i>
                           Dec 10
                         </span>
                       </div>
                       <p>A shopping mall is a modern term for a form of shopping precinct or shopping center </p>
                     </div>

                   </div>
                 </li>
                 <li class="btn-toggle-list">
                   <div class="chat-user-list">
                     <div class="chat-img">
                       <img src="images/profile.jpg" alt="" class="img-responsive">
                     </div>
                     <div class="chat-short">
                       <div class="chat-short-top">
                         <h4>Ask mall in west java</h4>
                         <span class="chat-date">
                           <i class="mdi mdi-calendar"></i>
                           Dec 10
                         </span>
                       </div>
                       <p>A shopping mall is a modern term for a form of shopping precinct or shopping center </p>
                     </div>

                   </div>
                 </li>
                 <li class="btn-toggle-list">
                   <div class="chat-user-list">
                     <div class="chat-img">
                       <img src="images/profile.jpg" alt="" class="img-responsive">
                     </div>
                     <div class="chat-short">
                       <div class="chat-short-top">
                         <h4>Ask mall in west java</h4>
                         <span class="chat-date">
                           <i class="mdi mdi-calendar"></i>
                           Dec 10
                         </span>
                       </div>
                       <p>A shopping mall is a modern term for a form of shopping precinct or shopping center </p>
                     </div>

                   </div>
                 </li>
                 <li class="btn-toggle-list">
                   <div class="chat-user-list">
                     <div class="chat-img">
                       <img src="images/profile.jpg" alt="" class="img-responsive">
                     </div>
                     <div class="chat-short">
                       <div class="chat-short-top">
                         <h4>Ask mall in west java</h4>
                         <span class="chat-date">
                           <i class="mdi mdi-calendar"></i>
                           Dec 10
                         </span>
                       </div>
                       <p>A shopping mall is a modern term for a form of shopping precinct or shopping center </p>
                     </div>

                   </div>
                 </li>
                 <li class="btn-toggle-list">
                   <div class="chat-user-list">
                     <div class="chat-img">
                       <img src="images/profile.jpg" alt="" class="img-responsive">
                     </div>
                     <div class="chat-short">
                       <div class="chat-short-top">
                         <h4>Ask mall in west java</h4>
                         <span class="chat-date">
                           <i class="mdi mdi-calendar"></i>
                           Dec 10
                         </span>
                       </div>
                       <p>A shopping mall is a modern term for a form of shopping precinct or shopping center </p>
                     </div>

                   </div>
                 </li>
                 <li class="btn-toggle-list">
                   <div class="chat-user-list">
                     <div class="chat-img">
                       <img src="images/profile.jpg" alt="" class="img-responsive">
                     </div>
                     <div class="chat-short">
                       <div class="chat-short-top">
                         <h4>Ask mall in west java</h4>
                         <span class="chat-date">
                           <i class="mdi mdi-calendar"></i>
                           Dec 10
                         </span>
                       </div>
                       <p>A shopping mall is a modern term for a form of shopping precinct or shopping center </p>
                     </div>

                   </div>
                 </li>
                 <li class="btn-toggle-list">
                   <div class="chat-user-list">
                     <div class="chat-img">
                       <img src="images/profile.jpg" alt="" class="img-responsive">
                     </div>
                     <div class="chat-short">
                       <div class="chat-short-top">
                         <h4>Ask mall in west java</h4>
                         <span class="chat-date">
                           <i class="mdi mdi-calendar"></i>
                           Dec 10
                         </span>
                       </div>
                       <p>A shopping mall is a modern term for a form of shopping precinct or shopping center </p>
                     </div>

                   </div>
                 </li>
                 <li class="btn-toggle-list">
                   <div class="chat-user-list">
                     <div class="chat-img">
                       <img src="images/profile.jpg" alt="" class="img-responsive">
                     </div>
                     <div class="chat-short">
                       <div class="chat-short-top">
                         <h4>Ask mall in west java</h4>
                         <span class="chat-date">
                           <i class="mdi mdi-calendar"></i>
                           Dec 10
                         </span>
                       </div>
                       <p>A shopping mall is a modern term for a form of shopping precinct or shopping center </p>
                     </div>

                   </div>
                 </li>
                 <li class="btn-toggle-list">
                   <div class="chat-user-list">
                     <div class="chat-img">
                       <img src="images/profile.jpg" alt="" class="img-responsive">
                     </div>
                     <div class="chat-short">
                       <div class="chat-short-top">
                         <h4>Ask mall in west java</h4>
                         <span class="chat-date">
                           <i class="mdi mdi-calendar"></i>
                           Dec 10
                         </span>
                       </div>
                       <p>A shopping mall is a modern term for a form of shopping precinct or shopping center </p>
                     </div>

                   </div>
                 </li>
                 <li class="btn-toggle-list">
                   <div class="chat-user-list">
                     <div class="chat-img">
                       <img src="images/profile.jpg" alt="" class="img-responsive">
                     </div>
                     <div class="chat-short">
                       <div class="chat-short-top">
                         <h4>Ask mall in west java</h4>
                         <span class="chat-date">
                           <i class="mdi mdi-calendar"></i>
                           Dec 10
                         </span>
                       </div>
                       <p>A shopping mall is a modern term for a form of shopping precinct or shopping center </p>
                     </div>

                   </div>
                 </li>
                 <li class="btn-toggle-list">
                   <div class="chat-user-list">
                     <div class="chat-img">
                       <img src="images/profile.jpg" alt="" class="img-responsive">
                     </div>
                     <div class="chat-short">
                       <div class="chat-short-top">
                         <h4>Ask mall in west java</h4>
                         <span class="chat-date">
                           <i class="mdi mdi-calendar"></i>
                           Dec 10
                         </span>
                       </div>
                       <p>A shopping mall is a modern term for a form of shopping precinct or shopping center </p>
                     </div>

                   </div>
                 </li>
                 <li class="btn-toggle-list">
                   <div class="chat-user-list">
                     <div class="chat-img">
                       <img src="images/profile.jpg" alt="" class="img-responsive">
                     </div>
                     <div class="chat-short">
                       <div class="chat-short-top">
                         <h4>Ask mall in west java</h4>
                         <span class="chat-date">
                           <i class="mdi mdi-calendar"></i>
                           Dec 10
                         </span>
                       </div>
                       <p>A shopping mall is a modern term for a form of shopping precinct or shopping center </p>
                     </div>

                   </div>
                 </li>
                 <li class="btn-toggle-list">
                   <div class="chat-user-list">
                     <div class="chat-img">
                       <img src="images/profile.jpg" alt="" class="img-responsive">
                     </div>
                     <div class="chat-short">
                       <div class="chat-short-top">
                         <h4>Ask mall in west java</h4>
                         <span class="chat-date">
                           <i class="mdi mdi-calendar"></i>
                           Dec 10
                         </span>
                       </div>
                       <p>A shopping mall is a modern term for a form of shopping precinct or shopping center </p>
                     </div>

                   </div>
                 </li>
                 <li class="btn-toggle-list">
                   <div class="chat-user-list">
                     <div class="chat-img">
                       <img src="images/profile.jpg" alt="" class="img-responsive">
                     </div>
                     <div class="chat-short">
                       <div class="chat-short-top">
                         <h4>Ask mall in west java</h4>
                         <span class="chat-date">
                           <i class="mdi mdi-calendar"></i>
                           Dec 10
                         </span>
                       </div>
                       <p>A shopping mall is a modern term for a form of shopping precinct or shopping center </p>
                     </div>

                   </div>
                 </li>
                 <li class="btn-toggle-list">
                   <div class="chat-user-list">
                     <div class="chat-img">
                       <img src="images/profile.jpg" alt="" class="img-responsive">
                     </div>
                     <div class="chat-short">
                       <div class="chat-short-top">
                         <h4>Ask mall in west java</h4>
                         <span class="chat-date">
                           <i class="mdi mdi-calendar"></i>
                           Dec 10
                         </span>
                       </div>
                       <p>A shopping mall is a modern term for a form of shopping precinct or shopping center </p>
                     </div>

                   </div>
                 </li>
                 <li class="btn-toggle-list">
                   <div class="chat-user-list">
                     <div class="chat-img">
                       <img src="images/profile.jpg" alt="" class="img-responsive">
                     </div>
                     <div class="chat-short">
                       <div class="chat-short-top">
                         <h4>Ask mall in west java</h4>
                         <span class="chat-date">
                           <i class="mdi mdi-calendar"></i>
                           Dec 10
                         </span>
                       </div>
                       <p>A shopping mall is a modern term for a form of shopping precinct or shopping center </p>
                     </div>

                   </div>
                 </li>
                 <li class="btn-toggle-list">
                   <div class="chat-user-list">
                     <div class="chat-img">
                       <img src="images/profile.jpg" alt="" class="img-responsive">
                     </div>
                     <div class="chat-short">
                       <div class="chat-short-top">
                         <h4>Ask mall in west java</h4>
                         <span class="chat-date">
                           <i class="mdi mdi-calendar"></i>
                           Dec 10
                         </span>
                       </div>
                       <p>A shopping mall is a modern term for a form of shopping precinct or shopping center </p>
                     </div>

                   </div>
                 </li>
                 <li class="btn-toggle-list">
                   <div class="chat-user-list">
                     <div class="chat-img">
                       <img src="images/profile.jpg" alt="" class="img-responsive">
                     </div>
                     <div class="chat-short">
                       <div class="chat-short-top">
                         <h4>Ask mall in west java</h4>
                         <span class="chat-date">
                           <i class="mdi mdi-calendar"></i>
                           Dec 10
                         </span>
                       </div>
                       <p>A shopping mall is a modern term for a form of shopping precinct or shopping center </p>
                     </div>

                   </div>
                 </li>
                 <li class="btn-toggle-list">
                   <div class="chat-user-list">
                     <div class="chat-img">
                       <img src="images/profile.jpg" alt="" class="img-responsive">
                     </div>
                     <div class="chat-short">
                       <div class="chat-short-top">
                         <h4>Ask mall in west java</h4>
                         <span class="chat-date">
                           <i class="mdi mdi-calendar"></i>
                           Dec 10
                         </span>
                       </div>
                       <p>A shopping mall is a modern term for a form of shopping precinct or shopping center </p>
                     </div>

                   </div>
                 </li>
                 <li class="btn-toggle-list">
                   <div class="chat-user-list">
                     <div class="chat-img">
                       <img src="images/profile.jpg" alt="" class="img-responsive">
                     </div>
                     <div class="chat-short">
                       <div class="chat-short-top">
                         <h4>Ask mall in west java</h4>
                         <span class="chat-date">
                           <i class="mdi mdi-calendar"></i>
                           Dec 10
                         </span>
                       </div>
                       <p>A shopping mall is a modern term for a form of shopping precinct or shopping center </p>
                     </div>

                   </div>
                 </li>
                 <li class="btn-toggle-list">
                   <div class="chat-user-list">
                     <div class="chat-img">
                       <img src="images/profile.jpg" alt="" class="img-responsive">
                     </div>
                     <div class="chat-short">
                       <div class="chat-short-top">
                         <h4>Ask mall in west java</h4>
                         <span class="chat-date">
                           <i class="mdi mdi-calendar"></i>
                           Dec 10
                         </span>
                       </div>
                       <p>A shopping mall is a modern term for a form of shopping precinct or shopping center </p>
                     </div>

                   </div>
                 </li>
                 <li class="btn-toggle-list">
                   <div class="chat-user-list">
                     <div class="chat-img">
                       <img src="images/profile.jpg" alt="" class="img-responsive">
                     </div>
                     <div class="chat-short">
                       <div class="chat-short-top">
                         <h4>Ask mall in west java</h4>
                         <span class="chat-date">
                           <i class="mdi mdi-calendar"></i>
                           Dec 10
                         </span>
                       </div>
                       <p>A shopping mall is a modern term for a form of shopping precinct or shopping center </p>
                     </div>

                   </div>
                 </li>

               </ul>
             </div>
             <!--<div class="bottom-chat">
               y
             </div>-->
           </div>
          </aside>
          <div class="chat-content">
            <div class="chat-wrap">
              <div class="chat-content-top">
                <div class="chat-user-top">
                  <div class="top-user-chat online">
                    <button type="button" class="btn btn-chat-list btn-toggle-list">
                      <i class="icon icon-chat"></i>
                    </button>
                    <div class="chat-image">
                      <img src="images/profile.jpg" alt="" class="img-fluid">
                      <span class="user-status">
                      <i class="mdi mdi-circle"></i>
                      </span>
                    </div>
                    <div class="chat-user-info">
                      <h5>Neng Osin Krotonos</h5>
                      <span>User | <i class="icon icon-placeholder"></i> Cikoneng, Jawa Barat</span>
                    </div>
                  </div>
                  <button class="btn btn-default btn-sm">
                    <i class="icon icon-delete"></i> Delete
                  </button>
                </div>
              </div>
              <div class="chat-content-center">
                <div class="chat-text">
                  <div class="chat-block user-text">
                    <div class="chat-input">
                      <div class="chat-date-status">
                        01 Dec | <span class="read-status read"><i class="mdi mdi-check-circle"></i></span> 19:00
                      </div>
                      <div class="chat-message">
                        hi admin, desa di buahbatu ada something potensi wisata semacam mall bisa gak
                      </div>
                    </div>
                  </div>
                  <div class="chat-block">
                    <div class="chat-input">
                      <div class="chat-date-status">
                        01 Dec | <span class="read-status read"><i class="mdi mdi-check-circle"></i></span> 19:05
                      </div>
                      <div class="chat-message">
                        hi neng osin, terima kasih telah mengirimkan informasi nya, saya ujang rante sebagey admin, bisa di kasih tahu lebih detail lokasi dan lain lain nya?
                      </div>
                    </div>
                  </div>
                  <div class="chat-block user-text">
                    <div class="chat-input">
                      <div class="chat-date-status">
                        01 Dec | <span class="read-status read"><i class="mdi mdi-check-circle"></i></span> 19:20
                      </div>
                      <div class="chat-message">
                        tah eta mang ujang, abdi hilap detil nya mh, ngan apal palebah na hungkul di pengkolan weh pokona mh, engke wang selfie keun geura
                      </div>
                    </div>
                  </div>
                  <div class="chat-block">
                    <div class="chat-input">
                      <div class="chat-date-status">
                        01 Dec | <span class="read-status read"><i class="mdi mdi-check-circle"></i></span> 19:25
                      </div>
                      <div class="chat-message">
                        hok atuh fotokin weh, neng
                      </div>
                    </div>
                  </div>
                  <div class="chat-block user-text">
                    <div class="chat-input">
                      <div class="chat-date-status">
                        01 Dec | <span class="read-status read"><i class="mdi mdi-check-circle"></i></span> 19:30
                      </div>
                      <div class="chat-message">
                        <img src="images/sample-photo-lahan.jpg" alt="" class="img-fluid">
                      </div>
                    </div>
                  </div>
                  <div class="chat-block">
                    <div class="chat-input">
                      <div class="chat-date-status">
                        01 Dec | <span class="read-status read"><i class="mdi mdi-check-circle"></i></span> 19:35
                      </div>
                      <div class="chat-message">
                       sip, neng engke di follow up deui
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="chat-content-bottom">
                <div class="chat-action">
                  <textarea class="form-control" placeholder="entry messages"></textarea>
                    <div class="button-group">
                      <button type="button" class="btn btn-clean"><i class="mdi mdi-plus-circle-outline"></i> Tambah File</button>
                      <button type="submit" class="btn btn-default">Kirim</button>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>



@endsection

@section('script')
<script src="//cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.0/handlebars.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.1.1/list.min.js"></script>
<script type="text/javascript">
    (function () {

        var chat = {
            messageToSend: '',
            messageResponses: [
                'Why did the web developer leave the restaurant? Because of the table layout.',
                'How do you comfort a JavaScript bug? You console it.',
                'An SQL query enters a bar, approaches two tables and asks: "May I join you?"',
                'What is the most used language in programming? Profanity.',
                'What is the object-oriented way to become wealthy? Inheritance.',
                'An SEO expert walks into a bar, bars, pub, tavern, public house, Irish pub, drinks, beer, alcohol'
            ],
            init: function () {
                this.cacheDOM();
                this.bindEvents();
                this.render();
            },
            cacheDOM: function () {
                this.$chatHistory = $('.chat-history');
                this.$button = $('button');
                this.$textarea = $('#message-to-send');
                this.$chatHistoryList = this.$chatHistory.find('ul');
            },
            bindEvents: function () {
                this.$button.on('click', this.addMessage.bind(this));
                this.$textarea.on('keyup', this.addMessageEnter.bind(this));
            },
            render: function () {
                this.scrollToBottom();
                if (this.messageToSend.trim() !== '') {
                    var template = Handlebars.compile($("#message-template").html());
                    var context = {
                        messageOutput: this.messageToSend,
                        time: this.getCurrentTime()
                    };

                    this.$chatHistoryList.append(template(context));
                    this.scrollToBottom();
                    this.$textarea.val('');

                    // responses
                    var templateResponse = Handlebars.compile($("#message-response-template").html());
                    var contextResponse = {
                        response: this.getRandomItem(this.messageResponses),
                        time: this.getCurrentTime()
                    };

                    setTimeout(function () {
                        this.$chatHistoryList.append(templateResponse(contextResponse));
                        this.scrollToBottom();
                    }.bind(this), 1500);

                }

            },

            addMessage: function () {
                this.messageToSend = this.$textarea.val()
                this.render();
            },
            addMessageEnter: function (event) {
                // enter was pressed
                if (event.keyCode === 13) {
                    this.addMessage();
                }
            },
            scrollToBottom: function () {
                this.$chatHistory.scrollTop(this.$chatHistory[0].scrollHeight);
            },
            getCurrentTime: function () {
                return new Date().toLocaleTimeString().
                replace(/([\d]+:[\d]{2})(:[\d]{2})(.*)/, "$1$3");
            },
            getRandomItem: function (arr) {
                return arr[Math.floor(Math.random() * arr.length)];
            }

        };

        chat.init();

        var searchFilter = {
            options: {
                valueNames: ['name']
            },
            init: function () {
                var userList = new List('people-list', this.options);
                var noItems = $('<li id="no-items-found">No items found</li>');

                userList.on('updated', function (list) {
                    if (list.matchingItems.length === 0) {
                        $(list.list).append(noItems);
                    } else {
                        noItems.detach();
                    }
                });
            }
        };

        searchFilter.init();

    })();

</script>
@endsection
