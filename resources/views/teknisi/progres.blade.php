@extends('layouts.induk')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card shadow mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark card-title">Pengaduan Progres</h6>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>No. Telp</th>
                  <th>Isi Aduan</th>
                  <th>Tgl. Aduan</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($followups as $followup)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $followup->pengaduan->nama }}</td>
                  <td>{{ $followup->pengaduan->no_telp }}</td>
                  <td>{{ $followup->pengaduan->isi_aduan }}</td>
                  <td>{{ \Carbon\Carbon::parse($followup->pengaduan->tgl_aduan)->format('d-m-Y') }}</td>
                  <td>{{ $followup->pengaduan->status }}</td>
                  <td> 
                    @if($followup->pengaduan->status == 'Progres') 
                        @if(empty($followup->penyelesaian))
                        <button type="button" title="Update Laporan" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#ModalUpdate{{ $followup->id }}"><i class="fa fa-edit text-white"></i></button>
                        @endif
                    <button type="button" title="Upload Signature" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#CustomerSignature{{ $followup->id }}"><i class="fa fa-paint-brush text-white"></i></button>
                    @endif
                   <a href="/pengaduan/detail/{{ $followup->id }}" title="Detail" class="btn btn-sm btn-secondary"><i class="fa fa-list text-white"></i></a>
                  </td>
                </tr>

                <!-- Modal Update -->
                <div class="modal fade" id="ModalUpdate{{$followup->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Update Laporan</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="/pengaduan/progres/update/{{$followup->id}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="penyelesaian">Penyelesaian</label>
                                <textarea rows="3" class="form-control" id="penyelesaian" name="penyelesaian" required></textarea>
                              </div>   
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                <!-- Modal Signature-->
                <div class="modal fade" id="CustomerSignature{{ $followup->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Signature</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                        <div class="modal-body">
                          <form action="{{ route('simpan.ttd', $followup->id) }}" method="post">
                            @csrf
                              <div class="form-row">
                                <div class="form-group col-md-12">
                                  <label class="" for="sig{{ $followup->id }}">Tanda Tangan Pelapor</label>
                                  <div id="sig{{ $followup->id }}" class="sig"></div>
                                  <textarea id="signature64" class="signature64" name="signed" style="display: none" required></textarea>
                                </div>
                              </div>
                              <button type="submit" class="btn btn-success">Save</button>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" id="clear" class="btn btn-warning clear">Clear</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                  </div>
                </div>

                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection

@section('signature-pad')
<script type="text/javascript">
/*! http://keith-wood.name/signature.html
    Signature plugin for jQuery UI v1.2.1.
    Requires excanvas.js in IE.
    Written by Keith Wood (wood.keith{at}optusnet.com.au) April 2012.
    Available under the MIT (http://keith-wood.name/licence.html) license. 
    Please attribute the author if you use it. */

/* globals G_vmlCanvasManager */

(function($) { // Hide scope, no $ conflict
    'use strict';


    var signatureOverrides = {

        
        options: {
            distance: 0,
            background: '#fff',
            color: '#000',
            thickness: 2,
            guideline: false,
            guidelineColor: '#a0a0a0',
            guidelineOffset: 50,
            guidelineIndent: 10,
            notAvailable: 'Your browser doesn\'t support signing',
            scale: 1,
            syncField: null,
            syncFormat: 'JSON',
            svgStyles: false,
            change: null
        },

        /** Initialise a new signature area.
            @memberof Signature
            @private */
        _create: function() {
            this.element.addClass(this.widgetFullName || this.widgetBaseClass);
            try {
                this.canvas = $('<canvas width="' + this.element.width() + '" height="' +
                    this.element.height() + '">' + this.options.notAvailable + '</canvas>')[0];
                this.element.append(this.canvas);
            }
            catch (e) {
                $(this.canvas).remove();
                this.resize = true;
                this.canvas = document.createElement('canvas');
                this.canvas.setAttribute('width', this.element.width());
                this.canvas.setAttribute('height', this.element.height());
                this.canvas.innerHTML = this.options.notAvailable;
                this.element.append(this.canvas);
                /* jshint -W106 */
                if (G_vmlCanvasManager) { // Requires excanvas.js
                    G_vmlCanvasManager.initElement(this.canvas);
                }
                /* jshint +W106 */
            }
            this.ctx = this.canvas.getContext('2d');
            this._refresh(true);
            this._mouseInit();
        },

        /** Refresh the appearance of the signature area.
            @memberof Signature
            @private
            @param {boolean} init <code>true</code> if initialising. */
        _refresh: function(init) {
            if (this.resize) {
                var parent = $(this.canvas);
                $('div', this.canvas).css({width: parent.width(), height: parent.height()});
            }
            this.ctx.fillStyle = this.options.background;
            this.ctx.strokeStyle = this.options.color;
            this.ctx.lineWidth = this.options.thickness;
            this.ctx.lineCap = 'round';
            this.ctx.lineJoin = 'round';
            this.clear(init);
        },

        /** Clear the signature area.
            @memberof Signature
            @param {boolean} init <code>true</code> if initialising - internal use only.
            @example $(selector).signature('clear') */
        clear: function(init) {
            if (this.options.disabled) {
                return;
            }
            this.ctx.clearRect(0, 0, this.element.width(), this.element.height());
            this.ctx.fillRect(0, 0, this.element.width(), this.element.height());
            if (this.options.guideline) {
                this.ctx.save();
                this.ctx.strokeStyle = this.options.guidelineColor;
                this.ctx.lineWidth = 1;
                this.ctx.beginPath();
                this.ctx.moveTo(this.options.guidelineIndent,
                    this.element.height() - this.options.guidelineOffset);
                this.ctx.lineTo(this.element.width() - this.options.guidelineIndent,
                    this.element.height() - this.options.guidelineOffset);
                this.ctx.stroke();
                this.ctx.restore();
            }
            this.lines = [];
            if (!init) {
                this._changed();
            }
        },

        /** Synchronise changes and trigger a change event.
            @memberof Signature
            @private
            @param {Event} event The triggering event. */
        _changed: function(event) {
            if (this.options.syncField) {
                var output = '';
                switch (this.options.syncFormat) {
                    case 'PNG':
                        output = this.toDataURL();
                        break;
                    case 'JPEG':
                        output = this.toDataURL('image/jpeg');
                        break;
                    case 'SVG':
                        output = this.toSVG();
                        break;
                    default:
                        output = this.toJSON();
                }
                $(this.options.syncField).val(output);
            }
            this._trigger('change', event, {});
        },

        /** Refresh the signature when options change.
            @memberof Signature
            @private
            @param {object} options The new option values. */
        _setOptions: function(/* options */) {
            if (this._superApply) {
                this._superApply(arguments); // Base widget handling
            }
            else {
                $.Widget.prototype._setOptions.apply(this, arguments); // Base widget handling
            }
            var count = 0;
            var onlyDisable = true;
            for (var name in arguments[0]) {
                if (arguments[0].hasOwnProperty(name)) {
                    count++;
                    onlyDisable = onlyDisable && name === 'disabled';
                }
            }
            if (count > 1 || !onlyDisable) {
                this._refresh();
            }
        },

        /** Determine if dragging can start.
            @memberof Signature
            @private
            @param {Event} event The triggering mouse event.
            @return {boolean} <code>true</code> if allowed, <code>false</code> if not */
        _mouseCapture: function(/* event */) {
            return !this.options.disabled;
        },

        /** Start a new line.
            @memberof Signature
            @private
            @param {Event} event The triggering mouse event. */
        _mouseStart: function(event) {
            this.offset = this.element.offset();
            this.offset.left -= document.documentElement.scrollLeft || document.body.scrollLeft;
            this.offset.top -= document.documentElement.scrollTop || document.body.scrollTop;
            this.lastPoint = [this._round(event.clientX - this.offset.left),
                this._round(event.clientY - this.offset.top)];
            this.curLine = [this.lastPoint];
            this.lines.push(this.curLine);
        },

        /** Track the mouse.
            @memberof Signature
            @private
            @param {Event} event The triggering mouse event. */
        _mouseDrag: function(event) {
            var point = [this._round(event.clientX - this.offset.left),
                this._round(event.clientY - this.offset.top)];
            this.curLine.push(point);
            this.ctx.beginPath();
            this.ctx.moveTo(this.lastPoint[0], this.lastPoint[1]);
            this.ctx.lineTo(point[0], point[1]);
            this.ctx.stroke();
            this.lastPoint = point;
        },

        /** End a line.
            @memberof Signature
            @private
            @param {Event} event The triggering mouse event. */
        _mouseStop: function(event) {
            if (this.curLine.length === 1) {
                event.clientY += this.options.thickness;
                this._mouseDrag(event);
            }
            this.lastPoint = null;
            this.curLine = null;
            this._changed(event);
        },

        /** Round to two decimal points.
            @memberof Signature
            @private
            @param {number} value The value to round.
            @return {number} The rounded value. */
        _round: function(value) {
            return Math.round(value * 100) / 100;
        },

        /** Convert the captured lines to JSON text.
            @memberof Signature
            @return {string} The JSON text version of the lines.
            @example var json = $(selector).signature('toJSON') */
        toJSON: function() {
            return '{"lines":[' + $.map(this.lines, function(line) {
                return '[' + $.map(line, function(point) {
                        return '[' + point + ']';
                    }) + ']';
            }) + ']}';
        },

        /** Convert the captured lines to SVG text.
            @memberof Signature
            @return {string} The SVG text version of the lines.
            @example var svg = $(selector).signature('toSVG') */
        toSVG: function() {
            var attrs1 = (this.options.svgStyles ? 'style="fill: ' + this.options.background + ';"' :
                'fill="' + this.options.background + '"');
            var attrs2 = (this.options.svgStyles ?
                'style="fill: none; stroke: ' + this.options.color + '; stroke-width: ' + this.options.thickness + ';"' :
                'fill="none" stroke="' + this.options.color + '" stroke-width="' + this.options.thickness + '"');
            return '<?xml version="1.0"?>\n<!DOCTYPE svg PUBLIC ' +
                '"-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">\n' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="15cm" height="15cm">\n' +
                '   <g ' + attrs1 + '>\n' +
                '       <rect x="0" y="0" width="' + this.canvas.width + '" height="' + this.canvas.height + '"/>\n' +
                '       <g ' + attrs2 + '>\n'+
                $.map(this.lines, function(line) {
                    return '            <polyline points="' +
                        $.map(line, function(point) { return point + ''; }).join(' ') + '"/>\n';
                }).join('') +
                '       </g>\n  </g>\n</svg>\n';
        },
        
        /** Convert the captured lines to an image encoded in a <code>data:</code> URL.
            @memberof Signature
            @param {string} [type='image/png'] The MIME type of the image.
            @param {number} [quality=0.92] The image quality, between 0 and 1.
            @return {string} The signature as a data: URL image.
            @example var data = $(selector).signature('toDataURL', 'image/jpeg') */
        toDataURL: function(type, quality) {
            return this.canvas.toDataURL(type, quality);
        },

        /** Draw a signature from its JSON or SVG description or <code>data:</code> URL.
            <p>Note that drawing a <code>data:</code> URL does not reconstruct the internal representation!</p>
            @memberof Signature
            @param {object|string} sig An object with attribute <code>lines</code> being an array of arrays of points
                            or the text version of the JSON or SVG or a <code>data:</code> URL containing an image.
            @example $(selector).signature('draw', sigAsJSON) */
        draw: function(sig) {
            if (this.options.disabled) {
                return;
            }
            this.clear(true);
            if (typeof sig === 'string' && sig.indexOf('data:') === 0) { // Data URL
                this._drawDataURL(sig, this.options.scale);
            } else if (typeof sig === 'string' && sig.indexOf('<svg') > -1) { // SVG
                this._drawSVG(sig, this.options.scale);
            } else {
                this._drawJSON(sig, this.options.scale);
            }
            this._changed();
        },

        /** Draw a signature from its JSON description.
            @memberof Signature
            @private
            @param {object|string} sig An object with attribute <code>lines</code> being an array of arrays of points
                            or the text version of the JSON.
            @param {number} scale A scaling factor. */
        _drawJSON: function(sig, scale) {
            if (typeof sig === 'string') {
                sig = $.parseJSON(sig);
            }
            this.lines = sig.lines || [];
            var ctx = this.ctx;
            $.each(this.lines, function() {
                ctx.beginPath();
                $.each(this, function(i) {
                    ctx[i === 0 ? 'moveTo' : 'lineTo'](this[0] * scale, this[1] * scale);
                });
                ctx.stroke();
            });
        },

        /** Draw a signature from its SVG description.
            @memberof Signature
            @private
            @param {string} sig The text version of the SVG.
            @param {number} scale A scaling factor. */
        _drawSVG: function(sig, scale) {
            var lines = this.lines = [];
            $(sig).find('polyline').each(function() {
                var line = [];
                $.each($(this).attr('points').split(' '), function(i, point) {
                    var xy = point.split(',');
                    line.push([parseFloat(xy[0]), parseFloat(xy[1])]);
                });
                lines.push(line);
            });
            var ctx = this.ctx;
            $.each(this.lines, function() {
                ctx.beginPath();
                $.each(this, function(i) {
                    ctx[i === 0 ? 'moveTo' : 'lineTo'](this[0] * scale, this[1] * scale);
                });
                ctx.stroke();
            });
        },

        /** Draw a signature from its <code>data:</code> URL.
            <p>Note that this does not reconstruct the internal representation!</p>
            @memberof Signature
            @private
            @param {string} sig The <code>data:</code> URL containing an image.
            @param {number} scale A scaling factor. */
        _drawDataURL: function(sig, scale) {
            var image = new Image();
            var context = this.ctx;
            image.onload = function() {
                context.drawImage(this, 0, 0, image.width * scale, image.height * scale);
            };
            image.src = sig;
        },

        /** Determine whether or not any drawing has occurred.
            @memberof Signature
            @return {boolean} <code>true</code> if not signed, <code>false</code> if signed.
            @example if ($(selector).signature('isEmpty')) ... */
        isEmpty: function() {
            return this.lines.length === 0;
        },

        /** Remove the signature functionality.
            @memberof Signature
            @private */
        _destroy: function() {
            this.element.removeClass(this.widgetFullName || this.widgetBaseClass);
            $(this.canvas).remove();
            this.canvas = this.ctx = this.lines = null;
            this._mouseDestroy();
        }
    };

    if (!$.Widget.prototype._destroy) {
        $.extend(signatureOverrides, {
            /* Remove the signature functionality. */
            destroy: function() {
                this._destroy();
                $.Widget.prototype.destroy.call(this); // Base widget handling
            }
        });
    }

    if ($.Widget.prototype._getCreateOptions === $.noop) {
        $.extend(signatureOverrides, {
            /* Restore the metadata functionality. */
            _getCreateOptions: function() {
                return $.metadata && $.metadata.get(this.element[0])[this.widgetName];
            }
        });
    }

    $.widget('kbw.signature', $.ui.mouse, signatureOverrides);

    // Make some things more accessible
    $.kbw.signature.options = $.kbw.signature.prototype.options;

})(jQuery);
</script>
<script type="text/javascript">
$('#widget').draggable();
  // for(var id = 0; id < 10; id++){
    var sig = $('.sig').signature({syncField: '.signature64', syncFormat: 'PNG'});
    $('.clear').click(function(e) {
      e.preventDefault();
      sig.signature('clear');
      $(".signature64").val('');
    });
  // }
</script>
@endsection