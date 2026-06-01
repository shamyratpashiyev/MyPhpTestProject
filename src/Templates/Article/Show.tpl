{extends file='../Layout/Layout.tpl'}
{block name=main}

    <div class="article_page">
        <div class="article_container">
            <div class="inner_wrapper">

                <div class="article_header">
                    <h1 class="article_title">{$article->Title}</h1>
                    <div class="article_metadata">
                        <span class="date">{$article->PublicationDate}</span>
                        <span class="views">{$article->ViewCount} views</span>
                    </div>
                </div>

                <img src="{$article->ImagePath}" class="article_image" alt="{$article->Title}"/>

                <p class="article_description">{$article->Description}</p>

                <p class="article_body">{$article->Text}</p>

                {if $relatedArticles->count() > 0}
                    <div class="related_articles_section">
                        <h4 class="title">Related Articles</h4>
                        <div class="article_cards_row">
                            {foreach $relatedArticles as $related}
                                <div class="article_card">
                                    <img src="{$related->ImagePath}" class="image" alt="{$related->Title}"/>
                                    <p class="title">{$related->Title}</p>
                                    <div class="article_metadata">
                                        <span class="date">{$related->PublicationDate}</span>
                                        <span class="views">{$related->ViewCount} views</span>
                                    </div>
                                    <p class="content">{$related->Text}</p>
                                    <a class="continue_button" href="/article?id={$related->Id}">Continue Reading</a>
                                </div>
                            {/foreach}
                        </div>
                    </div>
                {/if}

            </div>
        </div>
    </div>

{/block}

