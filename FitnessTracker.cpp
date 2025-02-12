#include <iostream>
#include <fstream>
#include <string>
#include<sstream>

using namespace std;

namespace FitnessTracker {

    // Predefined exercises (name, calorie burn rate)
    static const int NUM_PREDEFINED_EXERCISES = 15;
    static string predefinedExerciseNames[NUM_PREDEFINED_EXERCISES] = {
        "Running", "Cycling", "Swimming", "Jumping Jacks", "Weightlifting",
        "Yoga", "Hiking", "Rowing", "Jump Rope", "Kickboxing",
        "Pilates", "Zumba", "Aerobics", "Circuit Training", "Elliptical Training"
    };
    static double predefinedExerciseRates[NUM_PREDEFINED_EXERCISES] = {
        10.0, 8.0, 12.0, 6.0, 5.0, 3.0, 7.0, 9.0, 11.0, 13.0, 4.0, 7.0, 6.0, 9.0, 8.0
    };

    class Exercise {
    public:
        Exercise() : name(""), duration(0) {}  // Default constructor
        Exercise(string name, int duration) : name(name), duration(duration) {
            calculateCaloriesBurned();
        }

        string getName() const {
            return name;
        }

        int getDuration() const {
            return duration;
        }

        double getCaloriesBurned() const {
            return caloriesBurned;
        }

    private:
        string name;
        int duration;
        double caloriesBurned;

        void calculateCaloriesBurned() {
            const double caloriesBurnedRate = getCaloriesBurnRateByName(name);
            caloriesBurned = duration * caloriesBurnedRate;
        }

        double getCaloriesBurnRateByName(const string& exerciseName) const {
            for (int i = 0; i < NUM_PREDEFINED_EXERCISES; ++i) {
                if (predefinedExerciseNames[i] == exerciseName) {
                    return predefinedExerciseRates[i];
                }
            }
            cout << "Exercise not found in predefined list. Using default calorie burn rate.\n";
            return 7.0; // Default calorie burn rate (adjust as needed)
        }
    };

    class ExerciseGoal {
    public:
        ExerciseGoal(string type, int target, string timeframe)
            : type(type), target(target), timeframe(timeframe) {}

        string getType() const {
            return type;
        }

        int getTarget() const {
            return target;
        }

        string getTimeframe() const {
            return timeframe;
        }

    private:
        string type;
        int target;
        string timeframe;
    };

    class UserProfile {
    public:
        UserProfile(string username = "") : username(username), exerciseCount(0), totalDuration(0), totalCaloriesBurned(0.0) {}

        void addExercise(const Exercise& exercise) {
            if (exerciseCount < MAX_EXERCISES) {
                exercises[exerciseCount++] = exercise;
                totalDuration += exercise.getDuration();
                totalCaloriesBurned += exercise.getCaloriesBurned();
            } else {
                cerr << "Exercise limit reached.\n";
            }
        }

        void setExerciseGoal(const ExerciseGoal& goal) {
            exerciseGoal = goal;
            cout << "Exercise goal set: " << goal.getTarget() << " minutes per " << goal.getTimeframe() << endl;
        }

        void displaySummary() const {
            cout << "Fitness Tracker for: " << username << "\n";
            cout << "Exercises:\n";

            for (int i = 0; i < exerciseCount; ++i) {
                const Exercise& exercise = exercises[i];
                cout << "Exercise: " << exercise.getName() << ", Duration: " << exercise.getDuration() << " minutes, Calories Burned: " << exercise.getCaloriesBurned() << " calories\n";
            }

            cout << "Total Duration: " << totalDuration << " minutes\n";
            cout << "Total Calories Burned: " << totalCaloriesBurned << " calories\n";

            if (exerciseGoal.getTarget() > 0) {
                cout << "Exercise Goal: " << exerciseGoal.getTarget() << " minutes per " << exerciseGoal.getTimeframe() << endl;
            }
        }

        void saveDataToFile() const {
            ofstream outputFile(username + ".txt");
            if (outputFile.is_open()) {
                outputFile << "Exercise,Duration,Calories Burned\n";

                for (int i = 0; i < exerciseCount; ++i) {
                    const Exercise& exercise = exercises[i];
                    outputFile << exercise.getName() << "," << exercise.getDuration() << "," << exercise.getCaloriesBurned() << "\n";
                }

                outputFile << "\nTotal Duration," << "Total Calories Burned\n";
                outputFile << totalDuration << "," << totalCaloriesBurned << "\n";

                outputFile.close();
                cout << "Data saved to file.\n";
            } else {
                cerr << "Failed to save data to file.\n";
            }
        }

        void loadDataFromFile() {
            ifstream inputFile(username + ".txt");
            if (inputFile.is_open()) {
                string line;
                getline(inputFile, line); // Skip the header line
                while (getline(inputFile, line) && exerciseCount < MAX_EXERCISES) {
                    istringstream iss(line);
                    string name, duration, caloriesBurned;
                    getline(iss, name, ',');
                    getline(iss, duration, ',');
                    getline(iss, caloriesBurned, ',');

                    Exercise exercise(name, stoi(duration));
                    addExercise(exercise);
                }
                inputFile.close();
                cout << "Data loaded from file.\n";
            } else {
                cerr << "No data found for user: " << username << "\n";
            }
        }

        string getUsername() const {
            return username;
        }

    private:
        static const int MAX_EXERCISES = 100; // Maximum exercises that can be stored
        string username;
        Exercise exercises[MAX_EXERCISES];
        int exerciseCount;
        int totalDuration;
        double totalCaloriesBurned;
        ExerciseGoal exerciseGoal{"", 0, ""};
    };

    class FitnessTracker {
    public:
        void createUserProfile(const string& username) {
            if (userProfileCount < MAX_USERS) {
                userProfiles[userProfileCount++] = UserProfile(username);
            } else {
                cerr << "Maximum user limit reached. Cannot create a new profile.\n";
            }
        }

        UserProfile* getUserProfile(const string& username) {
            for (int i = 0; i < userProfileCount; ++i) {
                if (userProfiles[i].getUsername() == username) {
                    return &userProfiles[i];
                }
            }
            return nullptr;
        }

        void displayAllUserSummaries() const {
            for (int i = 0; i < userProfileCount; ++i) {
                const UserProfile& user = userProfiles[i];
                user.displaySummary();
                cout << "-----------------------------\n";
            }
        }

    private:
        static const int MAX_USERS = 100; // Maximum number of users
        UserProfile userProfiles[MAX_USERS];
        int userProfileCount = 0;
    };

} // namespace FitnessTracker

int main() {
    FitnessTracker::FitnessTracker fitnessTracker;

    while (true) {
        cout << "\nOptions:\n";
        cout << "1. Log in\n";
        cout << "2. Create a new profile\n";
        cout << "3. Exit\n";

        int loginChoice;
        cout << "Enter your choice: ";
        cin >> loginChoice;

        if (loginChoice == 3) {
            break;
        }

        string username;
        cout << "Enter your username: ";
        cin >> username;

        FitnessTracker::UserProfile* user = fitnessTracker.getUserProfile(username);

        if (loginChoice == 1) {
            if (user) {
                cout << "Logged in as " << username << ".\n";
            } else {
                cerr << "User not found. Please create a new profile.\n";
                continue;
            }
        } else if (loginChoice == 2) {
            if (!user) {
                fitnessTracker.createUserProfile(username);
                user = fitnessTracker.getUserProfile(username);
                cout << "New profile created for " << username << ".\n";
            } else {
                cerr << "User already exists. Please log in or choose a different username.\n";
                continue;
            }
        } else {
            cerr << "Invalid choice. Exiting...\n";
            break;
        }

        while (true) {
            cout << "\nOptions:\n";
            cout << "1. Log an exercise session\n";
            cout << "2. View exercise history\n";
            cout << "3. Set exercise goals\n";
            cout << "4. Save data to a file\n";
            cout << "5. Log out\n";
            cout << "6. Exit\n";

            int choice;
            cout << "Enter your choice: ";
            cin >> choice;

            switch (choice) {
                case 1: {
                    cout << "\nSelect an exercise:\n";
                    for (int i = 0; i < FitnessTracker::NUM_PREDEFINED_EXERCISES; ++i) {
                        cout << i + 1 << ". " << FitnessTracker::predefinedExerciseNames[i] << endl;
                    }

                    int exerciseChoice;
                    cout << "Enter the number corresponding to the exercise: ";
                    cin >> exerciseChoice;

                    if (exerciseChoice >= 1 && exerciseChoice <= FitnessTracker::NUM_PREDEFINED_EXERCISES) {
                        string selectedExercise = FitnessTracker::predefinedExerciseNames[exerciseChoice - 1];
                        int duration;
                        cout << "Enter exercise duration (minutes): ";
                        cin >> duration;

                        FitnessTracker::Exercise exercise(selectedExercise, duration);
                        user->addExercise(exercise);
                    } else {
                        cout << "Invalid exercise selection.\n";
                    }

                    break;
                }
                case 2:
                    user->displaySummary();
                    break;
                case 3: {
                    string type;
                    int target;
                    string timeframe;

                    cout << "Enter exercise goal type: ";
                    cin >> type;
                    cout << "Enter exercise goal target (minutes): ";
                    cin >> target;
                    cout << "Enter exercise goal timeframe: ";
                    cin >> timeframe;

                    FitnessTracker::ExerciseGoal goal(type, target, timeframe);
                    user->setExerciseGoal(goal);

                    break;
                }
                case 4:
                    user->saveDataToFile();
                    break;
                case 5:
                user->saveDataToFile();
                    cout << "Logged out.\n";
                    break;
                case 6:
                user->saveDataToFile();
                    return 0;
                default:
                    cout << "Invalid choice. Please try again.\n";
            }

            if (choice == 5) {
                user->saveDataToFile();
                break;
            }
        }
    }

    return 0;
}
