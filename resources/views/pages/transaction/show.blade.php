<?php

use App\Modules\EnumManager\Enums\PermissionTypeEnum;
?>

@extends('layout.master')

@section('content')
    <div class="container">


        <div class="card">
            <div class="card-body">
                <table>
                    <tr>
                        <td style="width: 100%; height: 100%">
                            <div class="d-flex flex-start align-items-center">
                                <img class="rounded-circle shadow-1-strong me-3"
                                     src="{{$transaction->author->getFirstMediaUrl('avatar')}}" alt="avatar" width="60"
                                     height="60" />
                                <div>
                                    <h6 class="fw-bold text-primary mb-1">{{$transaction->author->name}}</h6>
                                    <p class="text-muted small mb-0">
                                        {{$transaction->created_at->diffForHumans()}}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td style="width: 100%; height: 100%">
                            <div class="d-flex flex-end">
                                @if(ArticleService::isPending($transaction))
                                    @can(PermissionTypeEnum::ARTICLE_APPROVE_PERMISSION )
                                        <button id="publish-transaction" class="btn btn-primary">{{__('common.publish')}}</button>
                                    @endcan
                                @endif

                            </div>
                        </td>
                    </tr>
                </table>

                <h3 class="m-3">{{$transaction->title}}</h3>
                <img class="card-img-top" src="{{$transaction->getFirstMediaUrl('cover')}}" alt="Card image">
                <div class="mt-3 mb-4 pb-2" style="font-size: 20px">
                    {!! $transaction->description !!}
                </div>
            </div>
            <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                <div class="d-flex flex-start w-100">
                    <img class="rounded-circle shadow-1-strong me-3"
                         src="{{authUser()->getFirstMediaUrl('avatar')}}" alt="avatar" width="40"
                         height="40" />
                    <div class="form-outline w-100">
    <input class="form-control" id="comment-content" rows="4"
          style="background: #fff;">
                    </div>
                </div>
                <div class="float-end mt-2 pt-1">
                    <button type="button" id="post-comment" class="btn btn-primary btn-sm">Post comment</button>

                </div>
            </div>
        </div>

        <div class="card text-dark">
            <div class="card-body p-4 ">
                <h4 class="mb-0">Recent comments</h4>
                <div class="comment-section">

                </div>
                <a id="load-more" class="d-none m-2" href="javascript:void(0)"><p>{{__('common.load_more_comments')}}</p></a>
            </div>
        </div>


    </div>
@endsection

@push('custom-scripts')
    <script>
        // load comments
        var nextPageUrl = null;
        loadComment();

        $('#load-more').on('click', (e) => {
            e.preventDefault();

            // load comments
            callApi(nextPageUrl, 'GET', null, (data) =>  {
                $('.comment-section').append(data.comments);
                nextPageUrl = data.nextPageUrl;

                if (nextPageUrl == null) {
                    $('#load-more').addClass('d-none');
                } else {
                    $('#load-more').removeClass('d-none');
                }
            });
        });

        $('#post-comment').on('click', () => {
            callApi("{{route('comments.store', $transaction->id)}}", 'POST', {
                content:  $('#comment-content').val()
            });

            $('.comment-section').empty();
            loadComment();
            $('#comment-content').val('');
        });

        function loadComment() {
            callApi("{{route('comments.index', $transaction->id)}}", 'GET', null, (data) =>  {
                $('.comment-section').append(data.comments);
                nextPageUrl = data.nextPageUrl;

                if (nextPageUrl == null) {
                    $('#load-more').addClass('d-none');
                } else {
                    $('#load-more').removeClass('d-none');
                }
            });
        }

        $('#publish-transaction').on('click', () => {
            callApi("{{route('transactions.publish', $transaction->id)}}", 'POST', null, () => {
               $('#publish-transaction').hide();
            });
        });
    </script>
@endpush
