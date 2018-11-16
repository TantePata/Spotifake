package com.pugicorn.spotifake_server.mapper;

import com.pugicorn.spotifake_server.entity.Friend;
import com.pugicorn.spotifake_server.entity.User;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.CrudRepository;
import org.springframework.data.repository.query.Param;

import java.util.List;

// This will be AUTO IMPLEMENTED by Spring into a Bean called userRepository
// CRUD refers Create, Read, Update, Delete

public interface FriendRepository extends CrudRepository<Friend, String> {

    @Query("SELECT f FROM Friend f " +
            " WHERE f.user2 = :idUser and f.state='pending' order by f.state")
    List<Friend> findFriendToAccept(@Param("idUser") String idUser);

    @Query("SELECT u FROM User u LEFT JOIN Friend as f on u.id = f.user2 WHERE f.user1 = :idUser OR f.user2 = :idUser")
    List<User> findFriends(@Param("idUser") String idUser);

}