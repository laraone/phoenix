@push('content-block-custom-css')
    @if($settings->css){{ $settings->css }}@endif
@endpush

@push('content-block-css')
.section-{{ $block->unique_id }} {
    @if($settings->onClick == 'open-link')
    cursor: pointer;
    @endif
    height: {{ $settings->height }};
    padding: {{ $settings->padding }} !important;
    margin: {{ $settings->margin }} !important;
    {{-- overflow-x: {{ $settings->overflowX }};
    overflow-y: {{ $settings->overflowY }}; --}}

    @if($settings->display == 'flex')
        display: -webkit-box;
        display: -moz-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        flex-direction: {{$settings->flexDirection}};
        justify-content: {{$settings->justifyContent}};
        align-items: {{$settings->alignItems}};
        flex-wrap: {{$settings->flexWrap}};
        align-content: {{$settings->alignContent}};
    @else
        display: {{$settings->display}};
    @endif
    @if($settings->backgroundImage)
        background-image: url('{{$settings->backgroundImage}}');
        background-attachment: {{$settings->backgroundStyle}};
        background-position: {{$settings->backgroundPosition}};
        background-size: {{$settings->backgroundSize}};
        background-repeat: {{$settings->backgroundRepeat}};
        {{-- box-shadow: inset 0 0 0 2000px {{$settings->backgroundColor}}; --}}
    @else
        background-color: {{$settings->backgroundColor}};
    @endif

    @if($parentDisplay == 'flex')
        flex: {{ $settings->flex }};
        width: {{ $settings->width }};
        align-self: {{ $settings->alignSelf }};
    @else
        width: {{ $settings->width }};
    @endif
}

.section-{{ $block->unique_id }}:hover {
    @if($settings->backgroundColorAdvanced)background-color: {{ $settings->backgroundColorHover }};@endif
}

.section-{{ $block->unique_id }}:active {
    @if($settings->backgroundColorAdvanced)background-color: {{ $settings->backgroundColorActive }};@endif
}

.section-{{ $block->unique_id }}:focus {
    @if($settings->backgroundColorAdvanced)background-color: {{ $settings->backgroundColorFocus }};@endif
}
@endpush

@push('content-block-css-large')
.section-{{ $block->unique_id }} {
    height: {{$settings->heightLarge}};
    padding: {{$settings->paddingLarge}};
    margin: {{$settings->marginLarge}};
    @if($settings->displayResponsive)
        @if($settings->displayLarge == 'flex')
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
        @else
            display: {{$settings->displayLarge}};
        @endif
    @endif
    flex-direction: {{$settings->flexDirectionLarge}};
    justify-content: {{$settings->justifyContentLarge}};
    align-items: {{$settings->alignItemsLarge}};
    flex-wrap: {{$settings->flexWrapLarge}};
    align-content: {{$settings->alignContentLarge}};
}
@endpush

@push('content-block-css-medium')
.section-{{ $block->unique_id }} {
    height: {{$settings->heightMedium}};
    padding: {{$settings->paddingMedium}};
    margin: {{$settings->marginMedium}};
    @if($settings->displayResponsive)
        @if($settings->displayMedium == 'flex')
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            flex-direction: {{$settings->flexDirectionMedium}};
            justify-content: {{$settings->justifyContentMedium}};
            align-items: {{$settings->alignItemsMedium}};
            flex-wrap: {{$settings->flexWrapMedium}};
            align-content: {{$settings->alignContentMedium}};
        @else
            display: {{$settings->displayMedium}};
        @endif
    @endif
}
@endpush

@push('content-block-css-small')
.section-{{ $block->unique_id }} {
    height: {{$settings->heightSmall}};
    padding: {{$settings->paddingSmall}};
    margin: {{$settings->marginSmall}};
    @if($settings->displayResponsive)
        @if($settings->displaySmall == 'flex')
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            flex-direction: {{$settings->flexDirectionSmall}};
            justify-content: {{$settings->justifyContentSmall}};
            align-items: {{$settings->alignItemsSmall}};
            flex-wrap: {{$settings->flexWrapSmall}};
            align-content: {{$settings->alignContentSmall}};
        @else
            display: {{$settings->displaySmall}};
        @endif
    @endif
}
@endpush

@push('content-block-css-extra-small')
.section-{{ $block->unique_id }} {
    height: {{$settings->heightExtraSmall}};
    padding: {{$settings->paddingExtraSmall}};
    margin: {{$settings->marginExtraSmall}};
    @if($settings->displayResponsive)
        @if($settings->displayExtraSmall == 'flex')
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            flex-direction: {{$settings->flexDirectionExtraSmall}};
            justify-content: {{$settings->justifyContentExtraSmall}};
            align-items: {{$settings->alignItemsExtraSmall}};
            flex-wrap: {{$settings->flexWrapExtraSmall}};
            align-content: {{$settings->alignContentExtraSmall}};
        @else
            display: {{$settings->displayExtraSmall}};
        @endif
    @endif
}
@endpush
