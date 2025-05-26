@if(isset($desawisata->promosi[$i]))
        @if(($desawisata->promosi[$i]['jenis_promosi_id'] == $jsp->id) && ($desawisata->promosi[$i]['is_ada']=='1'))
                            @php
                                $selectYa = 'checked';
                                $selectTdk = '';
                            @endphp
                        @elseif(($desawisata->promosi[$i]['jenis_promosi_id'] == $jsp->id) && ($desawisata->promosi[$i]['is_ada']==0))
                            @php
                                $selectYa = '';
                                $selectTdk = 'checked';
                            @endphp
                        @else
                            @php
                                $selectYa = '';
                                $selectTdk = '';
                            @endphp
                        @endif

                        <div class="form-group has-three-fields reset-inline">
                            <div class="category-field">
                                <label class="control-label">{{$jsp->nama_jenis_promosi }}<em class="asterix">*</em></label>
                            </div>
                             <div class="category-field">
                                <div class="radio-group">
                                    <div class="ted-radio">
                                        <input  type="radio" name="jenis_promosi_id[]" value="1" {{ $selectYa }}>
                                        <label for="p1"><em>Ada</em></label>
                                    </div>
                                    <div class="ted-radio">
                                        <input type="radio" name="jenis_promosi_id[]" value="0"  {{ $selectTdk }}>
                                        <label for="p2"><em>Tidak</em></label>
                                    </div>
                                </div>
                            </div>
                            <div class="category-field end">
                                <textarea type="text" name="note[]" class="form-control col-4 note" placeholder="Keterangan Pelaksanaan">{{ ($desawisata->promosi[$i]['jenis_promosi_id'] == $jsp->id)?$desawisata->promosi[$i]['note']:'' }}</textarea>
                            </div>
                        </div>
                    @else

                    @endif
    @php $i++;
@endphp
