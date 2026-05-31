{extends file='../Layout/Layout.tpl'}
{block name=main}

    <div class="main_page">
        <div class="categories_container">
            <div class="inner_wrapper">
                {foreach $categoriesWithArticles as $category}
                    <div class="category_with_articles_container">
                        <div class="title_row">
                            <h4 class="category_name">{$category->Name}</h4>
                            <a class="view_all_button">View All</a>
                        </div>
                        <div class="article_cards_row">
                            {foreach $category->Articles as $article}
                                <div class="article_card">
                                    <img src="{$article->ImagePath}" class="image"/>
                                    <p class="title">{$article->Title}</p>
                                    <span class="date">{$article->PublicationDate}</span>
                                    <p class="content">{$article->Text}</p>
                                    <a class="continue_button">Continue Reading</a>
                                </div>
                            {/foreach}
                        </div>
                    </div>
                {/foreach}
            </div>
        </div>
    </div>
{/block}