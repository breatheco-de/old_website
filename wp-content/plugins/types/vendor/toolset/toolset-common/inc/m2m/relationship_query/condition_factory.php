<?php

/**
 * Factory of IToolset_Relationship_Query_Condition classes.
 *
 * @since 2.5.4
 */
class Toolset_Relationship_Query_Condition_Factory {

	/**
	 * Chain multiple conditions with OR.
	 *
	 * The whole statement will evaluate to true if at least one of provided conditions is true.
	 *
	 * @param IToolset_Relationship_Query_Condition[] $operands
	 * @return IToolset_Relationship_Query_Condition
	 */
	public function do_or( $operands ) {
		return new Toolset_Relationship_Query_Condition_Or( $operands );
	}


	/**
	 * Chain multiple conditions with AN.
	 *
	 * The whole statement will evaluate to true if all provided conditions are true.
	 *
	 * @param IToolset_Relationship_Query_Condition[] $operands
	 * @return IToolset_Relationship_Query_Condition
	 */
	public function do_and( $operands ) {
		return new Toolset_Relationship_Query_Condition_And( $operands );
	}


	/**
	 * Condition that the relationship involves a certain domain.
	 *
	 * @param string $domain_name 'posts'|'users'|'terms'
	 * @param IToolset_Relationship_Role_Parent_Child $in_role
	 *
	 * @return IToolset_Relationship_Query_Condition
	 */
	public function has_domain( $domain_name, IToolset_Relationship_Role_Parent_Child $in_role ) {
		return new Toolset_Relationship_Query_Condition_Has_Domain( $domain_name, $in_role );
	}


	/**
	 * Condition that the relationship comes from a certain source
	 *
	 * @param string $origin
	 *
	 * @return Toolset_Relationship_Query_Condition_Origin
	 */
	public function origin( $origin ) {
		return new Toolset_Relationship_Query_Condition_Origin( $origin );
	}


	/**
	 * Condition that the relationship has a certain type in a given role.
	 *
	 * @param string $type
	 * @param IToolset_Relationship_Role_Parent_Child $in_role
	 *
	 * @return IToolset_Relationship_Query_Condition
	 */
	public function has_type( $type, IToolset_Relationship_Role_Parent_Child $in_role ) {
		return new Toolset_Relationship_Query_Condition_Type( $type, $in_role );
	}


	/**
	 * Condition that the relationship was migrated from the legacy implementation.
	 *
	 * @param bool $should_be_legacy
	 *
	 * @return IToolset_Relationship_Query_Condition
	 */
	public function is_legacy( $should_be_legacy = true ) {
		return new Toolset_Relationship_Query_Condition_Is_Legacy( $should_be_legacy );
	}


	/**
	 * Condition that the relationship is active.
	 *
	 * @param bool $should_be_active
	 *
	 * @return IToolset_Relationship_Query_Condition
	 */
	public function is_active( $should_be_active = true ) {
		return new Toolset_Relationship_Query_Condition_Is_Active( $should_be_active );
	}


	/**
	 * Condition that the relationship has at least one active post type in a given role (or another domain than posts).
	 *
	 * @param bool $has_active_post_types
	 * @param IToolset_Relationship_Role_Parent_Child $in_role
	 *
	 * @return IToolset_Relationship_Query_Condition|Toolset_Relationship_Query_Condition_Has_Active_Types
	 */
	public function has_active_post_types( $has_active_post_types, IToolset_Relationship_Role_Parent_Child $in_role ) {
		return new Toolset_Relationship_Query_Condition_Has_Active_Types( $has_active_post_types, $in_role );
	}


}