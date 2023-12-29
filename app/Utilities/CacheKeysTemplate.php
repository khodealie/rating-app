<?php

namespace App\Utilities;

class CacheKeysTemplate
{
    const PRODUCT_PRICE = "product||{productId}||price";
    const PRODUCT_APPROVED_COMMENT_COUNT = "product||{productId}||approvedCommentCount";
    const PRODUCT_VOTE_COUNT = "product||{productId}||vote||{rateNumber}||count";
}
