<?php 

 class Vote{

    private $conn;
    private $table = 'votes';

    public function __construct($db){
        $this->conn = $db;
    }

    public function addVote($voter_id, $nominee_id, $category, $comment) {
        if ($voter_id === $nominee_id) {
            return "You cannot vote for yourself.";
        }

        $query = "SELECT COUNT(*) FROM {$this->table} WHERE voter_id = :voter_id AND nominee_id = :nominee_id AND category = :category";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':voter_id', $voter_id);
        $stmt->bindParam(':nominee_id', $nominee_id);
        $stmt->bindParam(':category', $category);
        $stmt->execute();
        $existingVoteCount = $stmt->fetchColumn();
    
        if ($existingVoteCount > 0) {
            return "You have already voted for this person in this category.";
        }

        $query = "INSERT INTO {$this->table} (voter_id, nominee_id, category, comment) VALUES (:voter_id, :nominee_id, :category, :comment)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':voter_id', $voter_id);
        $stmt->bindParam(':nominee_id', $nominee_id);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':comment', $comment);
    
        if ($stmt->execute()) {
            return "Vote submitted successfully.";
        } else {
            return "Failed to submit vote.";
        }
    }
    

    public function getResults() {
        $query = "SELECT nominee_id, category, COUNT(*) as votes FROM {$this->table} GROUP BY nominee_id, category";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMostActiveVoters() {
        $query = "SELECT voter_id, COUNT(*) as votes_cast FROM {$this->table} GROUP BY voter_id ORDER BY votes_cast DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTopNomineesByCategory() {
        $query = "
            SELECT 
                v.category, 
                e.name AS nominee_name, 
                COUNT(v.id) AS total_votes
            FROM 
                votes v
            INNER JOIN 
                employees e ON v.nominee_id = e.id
            GROUP BY 
                v.category, v.nominee_id
            HAVING 
                COUNT(v.id) = (
                    SELECT MAX(total_votes) 
                    FROM (
                        SELECT 
                            COUNT(id) AS total_votes 
                        FROM 
                            votes 
                        WHERE 
                            category = v.category 
                        GROUP BY 
                            nominee_id
                    ) AS subquery
                )
            ORDER BY 
                total_votes DESC;
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getVotesByCategoryAndEmployee() {
    $query = "
        SELECT 
            e.name AS employee_name,
            v.category,
            COUNT(v.id) AS total_votes
        FROM 
            votes v
        INNER JOIN 
            employees e ON v.nominee_id = e.id
        GROUP BY 
            v.category, v.nominee_id
        ORDER BY 
            e.name ASC, v.category ASC;
    ";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}

?>