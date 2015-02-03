<?php

// ... autoload etc.

$category = Questions\Models\QuestionCategory::create([
    'title' => 'Numerical questions',
    'description' => 'This is a numerical question category',
]);

$category->save();

$questionSupportingInfo = Questions\Models\QuestionSupportingInfo::create([
    'slug' => 'pie-chart',
    'title' => 'Pie Chart',
    'description' => 'A pie chart!',
    'body' => "<div style='background: blue;'>[title]</div>",
]);

$questionSupportingInfo->save();

$questionFormat = Questions\Models\QuestionFormat::create([
    'title' => 'Calculating Ratios from Financial Transactions',
    'question_category_id' => $category->id
]);

$questionFormat->save();



Questions\QuestionBuilder::create(function(QuestionBuilder $q) use ($category, $questionSupportingInfo, $questionFormat)
{
    $q->setBody('How much wood?');

    $q->addAnswer('Lots', true);
    $q->addAnswer('Not much');
    $q->addAnswer('Not interested');

    $q->setCategory($category);

    $q->setFormat($questionFormat);


    $q->buildSupportingInfo($questionSupportingInfo, [
        'title' => 'number one',
    ]);


    $markup = <<<EOD
<div class="new-thing" style="background: #449944">This is the new markup</div>
EOD;

    $q->setSupportingInfoMarkup($markup);
});

$this->assertEquals(Question::count(), 6);