<?php
use Zizaco\FactoryMuff\Facade\FactoryMuff;
class CommentTest extends TestCase {

/**
 *  Test adding new comment
 */
public function testAddingNewComment()
{
  // Create a new Post
  $post = FactoryMuff::create('Post');
 
  // Create a new Comment
  $comment = new Comment(array('body' => 'A new comment.'));
 
  // Save the Comment to the Post
  $post->comments()->save($comment);
 
  // This Post should have one comment
  $this->assertCount(1, $post->comments);
}


}