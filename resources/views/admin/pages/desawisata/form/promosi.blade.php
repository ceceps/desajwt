<div class="setup-content">
        <div class="form-based">
            <div class="top-form">
            <h3 class="form-title">Promosi {{ isset($nama_desawisata)?$nama_desawisata:'' }}</h3>
                <p class="title-helper">Promosi yang dilakukan Desa Wisata dalam mendatangkan wisatawan </p>
            </div>
            @if(isset($jenis_promosi))
                @php $i=0; $j=0; @endphp
                @foreach($jenis_promosi as $jsp)
                <input type="hidden" name="jenis_promosi_id[]" value="{{ $jsp->id }}">
                    @if(isset($desawisata->promosi[$j]))
                        @if(($desawisata->promosi[$j]['jenis_promosi_id'] == $jsp->id) && ($desawisata->promosi[$j]['is_ada']=='1'))
                            @php
                                $selectYa = "checked";
                                $valYa = 1;
                                $valTdk = '';
                                $selectTdk = '';
                            @endphp
                        @elseif(($desawisata->promosi[$j]['jenis_promosi_id'] == $jsp->id) && ($desawisata->promosi[$j]['is_ada']==0))
                            @php
                                $selectYa = '';
                                $valYa = '';
                                $valTdk = 0;
                                $selectTdk = "checked";
                            @endphp
                        @else
                            @php
                                $selectYa = '';
                                $selectTdk = '';
                                $valYa = '';
                                $valTdk = '';
                            @endphp
                        @endif
                        <input type="hidden" name="id[]" class="id" value="{{ $desawisata->promosi[$j]['id'] }}">
                        <div class="form-group has-three-fields reset-inline">
                            <div class="category-field">
                                <label class="control-label">{{$jsp->nama_jenis_promosi }}<em class="asterix">*</em></label>

                            </div>
                            <div class="category-field">
                                <div class="radio-group">
                                    <div class="ted-radio">
                                    <input  id="p{{ $i+1 }}" type="radio" name="is_ada{{ $j }}" value="{{ $valYa }}" {{ $selectYa }}>
                                        <label for="p{{ $i+1 }}"><em>Ada</em></label>
                                    </div>
                                    <div class="ted-radio">
                                        <input id="p{{$i+2}}" type="radio" name="is_ada{{ $j }}" value="{{ $valTdk }}" {{ $selectTdk }}>
                                        <label for="p{{$i+2}}"><em>Tidak Ada</em></label>
                                    </div>
                                    @if($j==2) <input type="text" name="url" id="url" class="form-control" value="{!! $desawisata->promosi[$j]['url'] !!}">@endif
                                </div>
                            </div>
                            <div class="category-field end">
                                <textarea type="text" name="note[]" class="form-control col-4 note" placeholder="Keterangan Pelaksanaan">{{ ($desawisata->promosi[$j]['jenis_promosi_id'] == $jsp->id) ?$desawisata->promosi[$j]['note']:'' }}</textarea>
                            </div>
                        </div>
                    @else
                        <input type="hidden" name="id[]" class="id" >
                        <div class="form-group has-three-fields reset-inline">
                                <div class="category-field">
                                    {{-- <label class="control-label">Brosur/Leaflet, dll<em class="asterix">*</em></label> --}}
                                    <label class="control-label">{{$jsp->nama_jenis_promosi }}<em class="asterix">*</em></label>
                                </div>
                                <div class="category-field">
                                    <div class="radio-group">
                                        <div class="ted-radio">
                                            <input id="p{{ $i+1 }}" type="radio" name="is_ada{{ $j }}" value="1" class="form-control .isada">
                                            <label for="p{{ $i+1 }}"><em>Ada</em></label>
                                        </div>
                                        <div class="ted-radio">
                                            <input id="p{{ $i+2 }}" type="radio" name="is_ada{{ $j }}" value="0" class="form-control .isada">
                                            <label for="p{{ $i+2 }}"><em>Tidak</em></label>
                                        </div>
                                        @if($j==2) <input type="text" name="url" id="url" class="form-control">@endif
                                    </div>
                                </div>

                                <div class="category-field end">
                                    <textarea type="text" name="note[]" class="form-control col-4" placeholder="Keterangan Pelaksanaan"></textarea>
                                </div>
                            </div>
                    @endif
                  @php $j++; $i=$i+2; @endphp
                @endforeach
                    <input type="hidden" name="j" value="{{ $j }}">
            @endif

        </div>
</div>
