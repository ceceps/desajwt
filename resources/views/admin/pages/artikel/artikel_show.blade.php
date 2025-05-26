@extends('admin.layouts.layoutnew_admin')
@section('content')
<!-- begin single page dashboard -->
<div class="dashboard-single">
    @if(isset($artikel))
        @foreach($artikel as $data)
        @php
            $tglModif = ($data->created_at!='')?\DateTime::createFromFormat('Y-m-d H:i:s', $data->created_at):'';
            $updateTgl = ($data->created_at!='')?$tglModif->format('d M Y'):'';
            $updateJam = ($data->created_at!='')$tglModif->format('H:i:s'):'';
            $foto = isset($data->Media[0]->filename)?'images/data-artikel/'.$data->Media[0]->filename:'images/noimages.gif';

@endphp
    <div class="single-top">
        <!-- begin top dashboard -->
        <div class="dashboard-top">
            <div class="container-fluid">
                <div class="top-entry">
                    <div class="top-status has-back">
                        <button type="button" class="btn btn-clean btn-back" onclick="javascript:back(1)">
                          <i class="icon-back-1"></i>
                        </button>
                        <h3>{{ $data->judul }}</h3>
                    </div>
                    <div class="top-option">
                        <div class="date-text">
                            Terakhir di update <i class="icon-calendar"></i> {{ $updateTgl }}
                            <i class="mdi mdi-clock"></i> {{ $updateJam }}
                        </div>
                        <a href="{{ url('backend/desawisata/edit/'.$data->artikel_id) }}" class="btn btn-default btn-edit">
                            <i class="mdi mdi-lead-pencil"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end top dashboard -->
        <div class="media-placeholder">
            <img src="{{ asset($foto)}}" alt="jabar" class="img-fluid">
            <div class="top-info-detail">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-sm-12">
                            <div class="list-info">
                                <div class="info-text">
                                    <h5>Judul</h5>
                                    <h1>{{ ucwords(strtolower($data->judul)) }}</h1>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="place=-detail">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="place-information">
                        <div class="box-inline has-two">
                            <div class="box-item">
                                <div class="text-box">
                                    <span>Kategori :</span> {{ $data->kategori_artikel['nama'] }}
                                </div>
                                <div class="text-box">
                                    <span>Penulis : </span> {{ ucwords(strtolower($data->User['fullname'])) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="place-information">
                        <span class="text-spacer"></span> {!! nl2br($data->konten) !!}
                    </div>
                    <div class="detailBox">
                        <div class="titleBox">
                            <label>Komentar</label>
                        </div>
                        <div class="actionBox">
                            @if(isset($komentar))
                            <ul class="commentList">
                                <li>
                                    <div class="commenterImage">
                                    <img src="{{ asset('images/avatar/chat_avatar_01.jpg') }}" />
                                    </div>
                                    <div class="commentText">
                                        <span class="date sub-text">People | on December 23th, 2018</span>
                                        <div class="comment-entry">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse posuere,
                                                neque ut malesuada mattis, lorem sapien rhoncus nulla</p>
                                            <button type="button" class="btn btn-clean btn-reply" data-toggle="collapse" data-target="#responseBox"><i class="mdi mdi-reply"></i> Balas</button>
                                            <div id="responseBox" class="collapse">
                                                <div class="response-comment">
                                                    <a href="#" class="user-comment">
                                                                <img src="images/profile.jpg" alt="" class="img-fluid"/>
                                                              </a>
                                                    <form class="form-comment" role="form">
                                                        <div class="form-group">
                                                            <textarea rows="2" class="form-control" placeholder="write comment"></textarea>
                                                        </div>
                                                        <div class="form-group has-btn">
                                                            <button class="btn btn-default">Add</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </li>
                                <li class="reply">
                                    <div class="commenterImage">
                                        <img src="http://lorempixel.com/50/50/people/7" />
                                    </div>
                                    <div class="commentText">
                                        <span class="date sub-text">People | on December 23th, 2018</span>
                                        <div class="comment-entry">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse posuere,
                                                neque ut malesuada mattis, lorem sapien rhoncus nulla</p>
                                            <button type="button" class="btn btn-clean btn-reply" data-toggle="collapse" data-target="#responseBox1"><i class="mdi mdi-reply"></i> Balas</button>
                                            <div id="responseBox1" class="collapse">
                                                <div class="response-comment">
                                                    <a href="#" class="user-comment">
                                                                <img src="images/profile.jpg" alt="" class="img-fluid"/>
                                                              </a>
                                                    <form class="form-comment" role="form">
                                                        <div class="form-group">
                                                            <textarea rows="2" class="form-control" placeholder="write comment"></textarea>
                                                        </div>
                                                        <div class="form-group has-btn">
                                                            <button class="btn btn-default">Add</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="commenterImage">
                                        <img src="http://lorempixel.com/50/50/people/9" />
                                    </div>
                                    <div class="commentText">
                                        <span class="date sub-text">People | on December 23th, 2018</span>
                                        <div class="comment-entry">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse posuere,
                                                neque ut malesuada mattis, lorem sapien rhoncus nulla</p>
                                            <button type="button" class="btn btn-clean btn-reply" data-toggle="collapse" data-target="#responseBox2"><i class="mdi mdi-reply"></i> Balas</button>
                                            <div id="responseBox2" class="collapse">
                                                <div class="response-comment">
                                                    <a href="#" class="user-comment">
                                                                <img src="images/profile.jpg" alt="" class="img-fluid"/>
                                                              </a>
                                                    <form class="form-comment" role="form">
                                                        <div class="form-group">
                                                            <textarea rows="2" class="form-control" placeholder="write comment"></textarea>
                                                        </div>
                                                        <div class="form-group has-btn">
                                                            <button class="btn btn-default">Add</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="commenterImage">
                                        <img src="http://lorempixel.com/50/50/people/9" />
                                    </div>
                                    <div class="commentText">
                                        <span class="date sub-text">People | on December 23th, 2018</span>
                                        <div class="comment-entry">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse posuere,
                                                neque ut malesuada mattis, lorem sapien rhoncus nulla</p>
                                            <button type="button" class="btn btn-clean btn-reply" data-toggle="collapse" data-target="#responseBox3"><i class="mdi mdi-reply"></i> Balas</button>
                                            <div id="responseBox3" class="collapse">
                                                <div class="response-comment">
                                                    <a href="#" class="user-comment">
                                                                <img src="images/profile.jpg" alt="" class="img-fluid"/>
                                                              </a>
                                                    <form class="form-comment" role="form">
                                                        <div class="form-group">
                                                            <textarea rows="2" class="form-control" placeholder="write comment"></textarea>
                                                        </div>
                                                        <div class="form-group has-btn">
                                                            <button class="btn btn-default">Add</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                                          <span aria-hidden="true"><i class="mdi mdi-chevron-left"></i> </span>
                                                          <span class="sr-only">Previous</span>
                                                        </a>
                                                        </li>
                                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                        <li class="page-item">
                                                            <a class="page-link" href="#" aria-label="Next">
                                                          <span aria-hidden="true"><i class="mdi mdi-chevron-right"></i></span>
                                                          <span class="sr-only">Next</span>
                                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            @else
                                <p class="text-center">Belum Ada Komentar</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <aside class="place-aside">
                        <div class="panel has-color vertical reset lite">
                            <div class="top-panel">
                                <h3>Jumlah Viewer</h3>
                                <div class="circle-panel">
                                    <span>{{ isset($data->hits)?$data->hits:0 }}</span>
                                </div>
                            </div>
                            <div class="side-mid box-inline has-two">
                                <div class="box-item">
                                    {{--
                                    <div class="text-box">
                                        <span>Regulasi</span>

                                    </div> --}}
                                </div>

                            </div>

                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- end single page dashboard -->

    @endforeach @else
    <p class="text-center">Data Artikel Tidak Ditemukan</p>
    @endif
</div>
@endsection
