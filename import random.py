import random

class HangmanGame:
    """
    A complete Hangman game with multiple difficulty levels,
    word lists, and ASCII art visualization.
    """
    WORDS = {
        'easy': ['python', 'game', 'code', 'computer', 'program'],
        'medium': ['algorithm', 'programming', 'challenge', 'developer', 'software'],
        'hard': ['algorithm', 'cryptography', 'complexity', 'optimization', 'sophisticated']
    }
    
    HANGMAN_STAGES = [
        """
           -----
           |   |
               |
               |
               |
               |
        =========""",
        """
           -----
           |   |
           O   |
               |
               |
               |
        =========""",
        """
           -----
           |   |
           O   |
           |   |
               |
               |
        =========""",
        """
           -----
           |   |
           O   |
          /|   |
               |
               |
        =========""",
        """
           -----
           |   |
           O   |
          /|\  |
               |
               |
        =========""",
        """
           -----
           |   |
           O   |
          /|\  |
          /    |
               |
        =========""",
        """
           -----
           |   |
           O   |
          /|\  |
          / \  |
               |
        ========="""]
    
    def __init__(self, difficulty='medium'):
        self.difficulty = difficulty
        self.word = random.choice(self.WORDS[difficulty])
        self.guessed_letters = set()
        self.tries_left = 6
    
    def display_word(self):
        """Show the current state of the guessed word."""
        return ''.join(
            letter if letter in self.guessed_letters else '_' 
            for letter in self.word
        )
    
    def play(self):
        """Main game loop for Hangman."""
        print(f"Welcome to Hangman! ({self.difficulty.capitalize()} Level)")
        print(f"Word Length: {len(self.word)} letters")
        
        while self.tries_left > 0:
            # Display game state
            print(self.HANGMAN_STAGES[6 - self.tries_left])
            print("\nCurrent Word:", self.display_word())
            print(f"Tries Left: {self.tries_left}")
            print(f"Guessed Letters: {', '.join(sorted(self.guessed_letters))}")
            
            # Get player's guess
            guess = input("Guess a letter: ").lower()
            
            # Validate input
            if len(guess) != 1 or not guess.isalpha():
                print("Please enter a single letter.")
                continue
            
            if guess in self.guessed_letters:
                print("You've already guessed that letter!")
                continue
            
            self.guessed_letters.add(guess)
            
            # Check guess
            if guess in self.word:
                print("Good guess!")
                if set(self.word) <= self.guessed_letters:
                    print(f"Congratulations! You guessed the word: {self.word}")
                    return
            else:
                self.tries_left -= 1
                print("Wrong guess!")
        
        # Game over
        print(f"\nGame Over! The word was: {self.word}")
        print(self.HANGMAN_STAGES[6])

def main():
    while True:
        difficulty = input("Choose difficulty (easy/medium/hard): ").lower()
        if difficulty in ['easy', 'medium', 'hard']:
            game = HangmanGame(difficulty)
            game.play()
            break
        print("Invalid difficulty. Try again.")

if __name__ == "__main__":
    main()